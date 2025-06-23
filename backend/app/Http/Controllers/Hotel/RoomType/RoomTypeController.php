<?php

namespace App\Http\Controllers\Hotel\RoomType;

use App\DataTables\Hotel\RoomType\RoomTypeDataTable;
use App\Enums\Room\RoomStatus;
use App\Enums\RoomType\RoomTypeStatus;
use App\Http\Controllers\Admin\Amenity\AmenityController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Hotel\RoomType\RoomTypeRequest;
use App\Models\Amenity;
use App\Models\RoomType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoomTypeController extends Controller
{
    private $data;

    public function __construct()
    {
        parent::__construct();
    }

    public function getView()
    {
        return [
            'index' => 'hotel.room_types.index',
            'create' => 'hotel.room_types.create',
            'edit' => 'hotel.room_types.edit'
        ];
    }
    public function getRoute(): array
    {
        return [
            'index' => 'hotel.room_type.index',
            'create' => 'hotel.room_type.create',
            'edit' => 'hotel.room_type.edit',
            'delete' => 'hotel.room_type.delete'
        ];
    }
    public function index(RoomTypeDataTable $dataTable)
    {
        return $dataTable->render($this->view['index'], [
            'breadcrumbs' => $this->crums->add(__('Danh sách Loại phòng'))
        ]);
    }
    public function create($hotel_id)
    {
        $amenities = Amenity::all();
        $groupedAmenities = $amenities->groupBy('parent_id');
        $amenitiesTree = $this->buildAmenityTree($groupedAmenities);

        return view($this->view['create'], [
            'breadcrumbs' => $this->crums->add(
                __('Danh sách Loại phòng'),
                route($this->route['index'], $hotel_id)
            )->add('Thêm Loại phòng'),
            'amenitiesTree' => $amenitiesTree,
        ]);
    }
    public static function buildAmenityTree($grouped)
    {
        $result = [];

        if (!isset($grouped[null])) {
            return $result;
        }

        foreach ($grouped[null] as $parent) {
            $children = [];

            if (isset($grouped[$parent->id])) {
                foreach ($grouped[$parent->id] as $child) {
                    $children[$child->id] = $child->name;
                }
            }

            $result[$parent->id] = [
                'name' => $parent->name,
                'children' => $children
            ];
        }
        return $result;
    }

    public function store($hotel_id, RoomTypeRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->data = $request->validated();
            $this->data['status'] = $this->data['status'] ?? RoomTypeStatus::Discontinued->value;
            $this->data['hotel_id'] = $hotel_id;
            $bedTypeId = $this->data['bed_type_id'] ?? null;
            $amenities = $this->data['amenities'] ?? null;
            unset($this->data['bed_type_id'], $this->data['amenities']);

            $roomType = RoomType::create($this->data);
            if ($bedTypeId) {
                $roomType->bedType()->associate($bedTypeId);
                $roomType->save();
            }
            if ($amenities) {
                $roomType->amenities()->attach($amenities);
            }
            DB::commit();
            return redirect()->route($this->route['index'], $hotel_id)->with('success', 'Thêm thành công');
        } catch (Exception $e) {
            DB::rollback();
            Log::error('Lỗi tạo RoomType: ' . $e->getMessage());
            return redirect()->route($this->route['create'], $hotel_id)->with('error', 'Thêm thất bại');
        }
    }

    public function edit($hotel_id, $id)
    {
        $amenities = Amenity::all();
        $groupedAmenities = $amenities->groupBy('parent_id');
        $amenitiesTree = $this->buildAmenityTree($groupedAmenities);

        $room_type = RoomType::where('id', $id)->first();
        $roomTypeAmenities = [];
        foreach ($room_type->amenities as $item) {
            $roomTypeAmenities[] = $item->id;
        }
        return view($this->view['edit'], [
            'breadcrumbs' => $this->crums->add(__('Danh sách tiện nghi')),
            'roomTypeAmenities' => $roomTypeAmenities,
            'amenitiesTree' => $amenitiesTree,
            'room_type' => $room_type,
        ]);
    }

    public function update($hotel_id, RoomTypeRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->data = $request->validated();
            $this->data['status'] = $this->data['status'] ?? RoomTypeStatus::Discontinued->value;
            $this->data['hotel_id'] = $hotel_id;
            $this->data['bed_type_id'] = $this->data['bed_type_id'] ?? null;
            $amenities = $this->data['amenities'] ?? null;
            unset($this->data['amenities']);

            $roomType = RoomType::where('id', $this->data['id'])->first();

            $roomType->update($this->data);

            if ($amenities) {
                $roomType->amenities()->sync($amenities);
            }
            DB::commit();
            return redirect()->route($this->route['index'], $hotel_id)->with('success', 'Cập nhật thành công');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->route($this->route['edit'], ['hotel_id' => $hotel_id, 'id' => $this->data['id']])->with('error', 'Cập nhật thất bại');
        }
    }

    public function delete($hotel_id, $id)
    {
        DB::beginTransaction();
        try {
            // $currentBookings = $roomType->bookingDetails()
            //     ->whereHas('booking', fn($q) => $q->where('status', '!=', BookingStatus::Cancelled->value))
            //     ->count();
            $roomType = RoomType::where('id', $id)->first();
            if ($roomType) {
                $roomType->delete();
                DB::commit();
                return redirect()->route($this->route['index'], $hotel_id)->with('success', 'Xóa thành công');
            } else {
                return redirect()->route($this->route['index'], $hotel_id)->with('error', 'Không tìm thấy loại phòng');
            }
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->route($this->route['index'], $hotel_id)->with('error', 'Xóa thất bại');
        }
    }
}
