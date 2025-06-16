<?php

namespace App\Http\Controllers\Hotel\Hotel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Hotel\Hotel\HotelRequest;
use App\Models\Hotel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
            'index' => 'hotel.information.index',
        ];
    }

    public function getRoute(): array
    {
        return [
            'index' => 'hotel.information.index',
            'update' => 'hotel.information.update'
        ];
    }

    public function index($hotel_id)
    {
        $hotel = Hotel::where('id', $hotel_id)->first();
        return view($this->view['index'], [
            'breadcrumbs' => $this->crums->add(__('Thông tin khách sạn')),
            'hotel' => $hotel
        ]);
    }
    public function update(HotelRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->data = $request->validated();

            $hotel = Hotel::find($this->data['id']);
            $hotel->update($this->data);
            DB::commit();
            return redirect()->route($this->route['index'],$this->data['id'])->with('success', 'Cập nhập thành công');
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return redirect()->route($this->route['index'],$this->data['id'])->with('error', 'Cập nhập thất bại');
        }
    }
}
