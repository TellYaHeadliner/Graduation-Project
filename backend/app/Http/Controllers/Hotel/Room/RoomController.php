<?php

namespace App\Http\Controllers\Hotel\Room;

use App\DataTables\Hotel\Room\RoomDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Hotel\Room\RoomRequest;
use App\Models\RoomTypeVariant;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoomController extends Controller
{
    private $data;

    public function __construct()
    {
        parent::__construct();
    }

    public function getView()
    {
        return [
            'index' => 'hotel.rooms.index',
            'create' => 'hotel.rooms.create',
            'edit' => 'hotel.rooms.edit'
        ];
    }
    public function getRoute(): array
    {
        return [
            'index' => 'hotel.room.index',
            'create' => 'hotel.room.create',
            'edit' => 'hotel.room.edit',
            'delete' => 'hotel.room.delete'
        ];
    }
    public function index(RoomDataTable $dataTable)
    {
        return $dataTable->render($this->view['index'], [
            'breadcrumbs' => $this->crums->add(__('Danh sách phòng'))
        ]);
    }
    public function create($hotel_id, $room_type_variant_id)
    {
        $room_type_variant = RoomTypeVariant::with('roomType')->find($room_type_variant_id);
        return view($this->view['create'], [
            'breadcrumbs' => $this->crums->add(
                __('Danh sách Phòng'),
                route($this->route['index'], $hotel_id)
            )->add('Thêm Loại phòng'),
            'room_type_variant' => $room_type_variant,
            'RoomStatus' => \App\Enums\Room\RoomStatus::asSelectArray(),
        ]);
    }

    public function store($hotel_id, $room_type_variant_id, RoomRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->data = $request->validated();
            $room_type_variant = RoomTypeVariant::with('roomType')->find($room_type_variant_id);

            $this->data['code'] =  $room_type_variant->roomType->room_code . '-' . trim($this->data['code']);
            $this->data['hotel_id'] = $room_type_variant->roomType->hotel_id;

            RoomTypeVariant::find($room_type_variant_id)->rooms()->create($this->data);

            DB::commit();
            return redirect()->route($this->route['index'], $hotel_id)->with('success', 'Thêm thành công');
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return redirect()->route($this->route['create'], ['hotel_id' => $hotel_id, 'room_type_variant_id' => $room_type_variant_id])->with('error', 'Thêm thất bại');
        }
    }
}
