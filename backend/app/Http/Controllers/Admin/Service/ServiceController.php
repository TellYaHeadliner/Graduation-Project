<?php

namespace App\Http\Controllers\Admin\Service;

use App\DataTables\Admin\Service\ServiceDataTable;
use App\Enums\Service\ServiceStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Service\ServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    private $data;

    public function __construct()
    {
        parent::__construct();
    }

    public function getView(): array
    {
        return [
            'index' => 'admin.service.index',
            'create' => 'admin.service.create',
            'edit' => 'admin.service.edit'
        ];
    }

    public function getRoute(): array
    {
        return [
            'index' => 'admin.service.index',
            'create' => 'admin.service.create',
            'edit' => 'admin.service.edit',
            'delete' => 'admin.service.delete'
        ];
    }

    public function index(ServiceDataTable $dataTable)
    {
        return $dataTable->render($this->view['index'], [
            'breadcrumbs' => $this->crums->add(__('Danh sách dịch vụ'))
        ]);
    }

    public function create()
    {
        return view($this->view['create'], [
            'breadcrumbs' => $this->crums->add(
                ('Danh sách dịch vụ'),
                route($this->route['index'])
            )->add('Thêm dịch vụ')
        ]);
    }
    public function edit($id)
    {
        $service = Service::find($id);
        return view($this->view['edit'], [
            'breadcrumbs' => $this->crums->add(
                ('Danh sách dịch vụ'),
                route($this->route['index'])
            )->add('Cập nhập dịch vụ'),
            'service' => $service
        ]);
    }

    public function store(ServiceRequest $request)
    {
        $this->data = $request->validated();

        DB::beginTransaction();
        try {
            $this->data['status'] = $this->data['status'] ?? ServiceStatus::Suspended->value;

            Service::create($this->data);
            DB::commit();
            return redirect()->route($this->route['index'])->with('success', 'Thêm thành công');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->route($this->route['create'])->with('error', 'Thêm thất bại');
        }
    }

    public function update(ServiceRequest $request)
    {
        $this->data = $request->validated();
        try {

            $service = Service::find($this->data['id']);

            if ($service['name'] !== $this->data['name']) {
                if (Service::where('name', '=', $this->data['name'])->exists()) {
                    return redirect()->route($this->route['edit'], [$this->data['id']])->with('error', 'Dịch vụ đã tồn tại');
                }
            }
            $this->data['status'] = $this->data['status'] ?? ServiceStatus::Suspended->value;
            $service->update($this->data);
            DB::commit();
            return redirect()->route($this->route['index'])->with('success', 'Cập nhập thành công');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->route($this->route['edit'], [$this->data['id']])->with('error', 'Cập nhập thất bại');
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $this->data = Service::find($id);
            $hotelServiceIds = DB::table('hotel_services')
                ->where('service_id', $id)
                ->pluck('id');
            $isUsedInBookings = DB::table('booking_services')
                ->whereIn('hotel_service_id', $hotelServiceIds)
                ->exists();
            if ($hotelServiceIds->isNotEmpty() || $isUsedInBookings) {
                DB::rollBack();
                return redirect()->route($this->route['index'])
                    ->with('error', 'Không thể xóa dịch vụ vì đã có đơn đặt sử dụng trong hệ thống.');
            }
            $this->data->delete();
            DB::commit();
            return redirect()->route($this->route['index'])->with('success', 'Xóa thành công');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route($this->route['index'])->with('error', 'Xóa thất bại');
        }
    }
}
