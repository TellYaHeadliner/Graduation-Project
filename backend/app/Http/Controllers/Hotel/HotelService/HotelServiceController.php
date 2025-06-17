<?php

namespace App\Http\Controllers\Hotel\HotelService;

use App\DataTables\Hotel\HotelService\HotelServiceDataTable;
use App\Enums\HotelService\HotelServiceStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Hotel\HotelService\HotelServiceRequest;
use App\Models\Hotel;
use App\Models\HotelService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HotelServiceController extends Controller
{
    private $data;

    public function __construct()
    {
        parent::__construct();
    }

    public function getView()
    {
        return [
            'index' => 'hotel.hotel_services.index',
            'create' => 'hotel.hotel_services.create',
            'edit' => 'hotel.hotel_services.edit'
        ];
    }
    public function getRoute(): array
    {
        return [
            'index' => 'hotel.hotel_service.index',
            'create' => 'hotel.hotel_service.create',
            'edit' => 'hotel.hotel_service.edit',
            'delete' => 'hotel.hotel_service.delete'
        ];
    }
    public function index(HotelServiceDataTable $dataTable)
    {
        return $dataTable->render($this->view['index'], [
            'breadcrumbs' => $this->crums->add(__('Danh sách dịch vụ'))
        ]);
    }

    public function create($hotel_id)
    {
        return view($this->view['create'], [
            'breadcrumbs' => $this->crums->add(
                __('Danh sách dịch vụ'),
                route($this->route['index'], $hotel_id)
            )->add('Thêm dịch vụ'),
        ]);
    }

    public function store($hotel_id, HotelServiceRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->data = $request->validated();
            $this->data['status'] = $this->data['status'] ?? HotelServiceStatus::INACTIVE->value;

            if (HotelService::where(['hotel_id' => $hotel_id, 'service_id' => $this->data['service_id']])->exists()) {
                return redirect()->route($this->route['create'], $hotel_id)->with('error', 'Dịch vụ đã tồn tại trong khách sạn');
            }

            $hotel = Hotel::where('id', $hotel_id)->first();

            $hotel->services()->attach($this->data['service_id'], [
                'short_description' => $this->data['short_description'] ?? null,
                'base_price' => $this->data['base_price'],
                'promo_price' => $this->data['promo_price'] > 0 ? $this->data['promo_price'] : null,
                'status' => $this->data['status']
            ]);

            DB::commit();
            return redirect()->route($this->route['index'], $hotel_id)->with('success', 'Thêm thành công');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route($this->route['create'], $hotel_id)->with('error', 'Thêm thất bại');
        }
    }

    public function edit($hotel_id, $id)
    {
        $hotel_service = HotelService::with('service')->where('id', $id)->first();
        return view($this->view['edit'], [
            'breadcrumbs' => $this->crums->add(
                __('Danh sách dịch vụ'),
                route($this->route['index'], $hotel_id)
            )->add('Cập nhập thông tin dịch vụ'),
            'hotel_service' => $hotel_service,
        ]);
    }
    public function update($hotel_id, HotelServiceRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->data = $request->validated();
            $this->data['status'] = $this->data['status'] ?? HotelServiceStatus::INACTIVE->value;

            $hotel_service = HotelService::with('service')->where('id', $this->data['id'])->first();

            if ($hotel_service->service->id != $this->data['service_id']) {
                if (HotelService::where(['hotel_id' => $hotel_id, 'service_id' => $this->data['service_id']])->exists()) {
                    return redirect()->route($this->route['create'], $hotel_id)->with('error', 'Dịch vụ đã tồn tại trong khách sạn');
                }
            }

            $hotel_service->update([
                'service_id' => $this->data['service_id'],
                'base_price' => $this->data['base_price'],
                'promo_price' => $this->data['promo_price'] > 0 ? $this->data['promo_price'] : null,
                'short_description' => $this->data['short_description'] ?? null,
                'status' => $this->data['status']
            ]);
            DB::commit();
            return redirect()->route($this->route['index'], $hotel_id)->with('success', 'Thêm thành công');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route($this->route['edit'], ['hotel_id' => $hotel_id, 'id' => $this->data['id']])->with('error', 'Thêm thất bại');
        }
    }

    public function delete($hotel_id, $id)
    {
        DB::beginTransaction();
        try {
            $this->data = HotelService::find($id);
            $this->data->delete();
            DB::commit();
            return redirect()->route($this->route['index'],$hotel_id)->with('success', 'Xóa thành công');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route($this->route['index'],$hotel_id)->with('error', 'Xóa thất bại');
        }
    }
}
