<?php

namespace App\Http\Controllers\Hotel\Room;

use App\DataTables\Hotel\Room\RoomDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Hotel\Room\RoomRequest;
use App\Models\Room;
use App\Models\RoomType;
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
    public function create($hotel_id, $room_type_id)
    {
        $room_type = RoomType::find($room_type_id);
        return view($this->view['create'], [
            'breadcrumbs' => $this->crums->add(
                __('Danh sách Phòng'),
                route($this->route['index'], $hotel_id)
            )->add('Thêm Loại phòng'),
            'room_type' => $room_type,
            'RoomStatus' => \App\Enums\Room\RoomStatus::asSelectArray(),
        ]);
    }

    public function store($hotel_id, $room_type_id, RoomRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->data = $request->validated();
            $roomType = RoomType::find($room_type_id);

            $this->data['code'] =  $roomType->room_code . ' ' . trim($this->data['code']);
            $this->data['hotel_id'] = $roomType->hotel_id;

            if (Room::where('code', $this->data['code'])->exists()) {
                 return redirect()->route($this->route['create'], ['hotel_id' => $hotel_id, 'room_type_id' => $room_type_id])->with('error', 'Mã phòng đã tồn tại');
            }

            RoomType::find($room_type_id)->rooms()->create($this->data);

            DB::commit();
            return redirect()->route($this->route['index'], $hotel_id)->with('success', 'Thêm thành công');
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return redirect()->route($this->route['create'], ['hotel_id' => $hotel_id, 'room_type_id' => $room_type_id])->with('error', 'Thêm thất bại');
        }
    }
    public function edit($hotel_id, $room_type_id, $id)
    {
        $room = Room::find($id);
        $room_type = RoomType::find($room_type_id);
        return view($this->view['edit'], [
            'breadcrumbs' => $this->crums->add(
                __('Danh sách phòng'),
                route($this->route['index'], $hotel_id)
            )->add('Cập nhập thông tin phòng'),
            'room' => $room,
            'room_type' => $room_type,
            'RoomStatus' => \App\Enums\Room\RoomStatus::asSelectArray(),
        ]);
    }

    public function update($hotel_id, $room_type_id, RoomRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->data = $request->validated();

            $room = Room::find($this->data['id']);

            if ($room->code !== $this->data['code'] && Room::where('code', $this->data['code'])->exists()) {
                return redirect()->route($this->route['edit'], ['hotel_id' => $hotel_id, 'room_type_id' => $room_type_id, 'id' => $this->data['id']])->with('error', 'Mã phòng đã tồn tại');
            }
            $room->update($this->data);

            DB::commit();
            return redirect()->route($this->route['index'], $hotel_id)->with('success', 'Cập nhập thành công');
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return redirect()->route($this->route['edit'], ['hotel_id' => $hotel_id, 'room_type_id' => $room_type_id, 'id' => $this->data['id']])->with('error', 'Cập nhập thất bại');
        }
    }
    public function delete($hotel_id, $room_type_id, $id)
    {
        DB::beginTransaction();
        try {
            $this->data = Room::find($id);
            $this->data->delete();
            DB::commit();
            return redirect()->route($this->route['index'], $hotel_id)->with('success', 'Xóa thành công');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route($this->route['index'], $hotel_id)->with('error', 'Xóa thất bại');
        }
    }
}
