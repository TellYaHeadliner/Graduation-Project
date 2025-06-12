<?php

namespace App\Http\Controllers\Admin\Hotel;

use App\DataTables\Admin\Hotel\HotelApprovalDataTable;
use App\DataTables\Admin\Hotel\HotelDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Hotel\HotelRequest;
use App\Models\Hotel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class HotelController extends Controller
{
    private $data;

    public function __construct()
    {
        parent::__construct();
    }

    public function getView(): array
    {
        return [
            'index' => 'admin.hotel.index',
            'create' => 'admin.hotel.create',
            'edit' => 'admin.hotel.edit',
            'indexHotelApproval' => 'admin.hotel.hotel_approval.index',
            'editHotelApproval' => 'admin.hotel.hotel_approval.edit'
        ];
    }

    public function getRoute(): array
    {
        return [
            'index' => 'admin.hotel.index',
            'create' => 'admin.hotel.create',
            'edit' => 'admin.hotel.edit',
            'delete' => 'admin.hotel.delete',
            'indexHotelApproval' => 'admin.hotel.indexHotelApproval',
            'editHotelApproval' => 'admin.hotel.editHotelApproval'
        ];
    }

    public function index(HotelDataTable $dataTable)
    {
        return $dataTable->render($this->view['index'], [
            'breadcrumbs' => $this->crums->add(__('Danh sách khách sạn'))
        ]);
    }

    public function create()
    {
        return view($this->view['create'], [
            'breadcrumbs' => $this->crums->add(
                __('Danh sách khách sạn'),
                route($this->route['index'])
            )->add('Thêm khách sạn'),
        ]);
    }

    public function store(HotelRequest $request)
    {
        $this->data = $request->validated();
        DB::beginTransaction();
        try {
            if ($this->data['star_rating'] && $this->data['star_rating'] == 0) {
                unset($this->data['star_rating']);
            }
            $this->data['status'] = $this->data['status'] ?? '3';
            Hotel::create($this->data);
            DB::commit();
            return redirect()->route($this->route['index'])->with('success', 'Thêm thành công');
        } catch (Exception $e) {
            DB::rollback();
            Log::error('Lỗi thêm khách sạn: ' . $e->getMessage());
            return redirect()->route($this->route['create'])->with('error', 'Thêm thất bại');
        }
    }

    public function edit($id)
    {
        $hotel = Hotel::with('user')->find($id);

        return view($this->view['edit'], [
            'breadcrumbs' => $this->crums->add(
                __('Danh sách khách sạn'),
                route($this->route['index'])
            )->add('Cập nhập khách sạn'),
            'hotel' => $hotel
        ]);
    }

    public function update(HotelRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->data = $request->validated();
            $this->data['status'] = $this->data['status'] ?? 3;

            $hotel = Hotel::find($this->data['id']);
            $hotel->update($this->data);
            DB::commit();
            return redirect()->route($this->route['index'])->with('success', 'Cập nhập thành công');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route($this->route['edit'], [$this->data['id']])->with('error', 'Cập nhập thất bại');
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $this->data = Hotel::find($id);
            $this->data->delete();
            DB::commit();
            return redirect()->route($this->route['index'])->with('success', 'Xóa thành công');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route($this->route['index'])->with('error', 'Xóa thất bại');
        }
    }

    public function indexHotelApproval(HotelApprovalDataTable $dataTable)
    {
        return $dataTable->render($this->view['indexHotelApproval'], [
            'breadcrumbs' => $this->crums->add(__('Danh sách khách sạn đăng kí'))
        ]);
    }

    public function editHotelApproval($id)
    {
        $hotel = Hotel::with('user')->find($id);

        $response = Http::get('https://api.vietqr.io/v2/business/'.$hotel->mst);


        return view($this->view['editHotelApproval'], [
            'breadcrumbs' => $this->crums->add(
                __('Danh sách khách sạn'),
                route($this->route['index'])
            )->add('Duyệt khách sạn'),
            'hotel' => $hotel,
            'response' => $response->json()
        ]);
    }

    public function updateHotelApproval(HotelRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->data = $request->validated();

            $hotel = Hotel::find($this->data['id']);
            $hotel->update([
                'status' => 2
            ]);
            DB::commit();
            return redirect()->route($this->route['index'])->with('success', 'Cập nhập thành công');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route($this->route['editHotelApproval'], [$this->data['id']])->with('error', 'Cập nhập thất bại');
        }
    }
    public function deleteHotelApproval($id, Request $request)
    {
        DB::beginTransaction();
        try {
            $hotel = Hotel::find($id);
            $hotel->update([
                'status' => 4
            ]);
            DB::commit();
            return redirect()->route($this->route['indexHotelApproval'])->with('success', 'Cập nhập thành công');
        } catch (Exception $e) {
            DB::rollback();
            Log::error(  $e->getMessage());
            return redirect()->route($this->route['editHotelApproval'], $id)->with('error', 'Cập nhập thất bại');
        }
    }
}
