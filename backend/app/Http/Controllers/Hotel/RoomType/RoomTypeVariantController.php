<?php

namespace App\Http\Controllers\Hotel\RoomType;

use App\DataTables\Hotel\RoomTypeVariant\RoomTypeVariantDataTable;
use App\Enums\RoomTypeVariant\RoomTypeVariantStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Hotel\RoomTypeVariant\RoomTypeVariantRequest;
use App\Models\Attribute;
use App\Models\RoomType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoomTypeVariantController extends Controller
{
    private $data;

    public function __construct()
    {
        parent::__construct();
    }

    public function getView()
    {
        return [
            'index' => 'hotel.room_types.room_type_variants.index',
            'create' => 'hotel.room_types.room_type_variants.create',
            'edit' => 'hotel.room_types.room_type_variants.edit'
        ];
    }
    public function getRoute(): array
    {
        return [
            'index' => 'hotel.room_type_variant.index',
            'create' => 'hotel.room_type_variant.create',
            'edit' => 'hotel.room_type_variant.edit',
            'delete' => 'hotel.room_type_variant.delete'
        ];
    }
    public function index($hotel_id, $room_type_id, RoomTypeVariantDataTable $dataTable)
    {
        $room_type = RoomType::find($room_type_id);
        return $dataTable->with('room_type_id', $room_type_id)->render($this->view['index'], [
            'breadcrumbs' => $this->crums->add(__('Danh sách Loại phòng')),
            'room_type' => $room_type,
        ]);
    }
    public function create($hotel_id, $room_type_id)
    {
        $room_type = RoomType::find($room_type_id);
        return view($this->view['create'], [
            'breadcrumbs' => $this->crums->add(
                __('Danh sách Biến thể Loại phòng'),
                route($this->route['index'], ['hotel_id' => $hotel_id, 'room_type_id' => $room_type_id])
            )->add('Thêm Biến thể Loại phòng'),
            'room_type' => $room_type,
        ]);
    }

    public function store($hotel_id, $room_type_id, RoomTypeVariantRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->data = $request->validated();
            $this->data['status'] = $this->data['status'] ?? RoomTypeVariantStatus::Inactive->value;
            $this->data['room_type_id'] = $room_type_id;
            $this->data['discount_price'] = $this->data['discount_price'] > 0 ? $this->data['discount_price'] : null;
            $season = [];
            $season['season_id'] = $this->data['season_id'] ?? null;
            if (isset($season['season_id'])) {
                $season['discount_type'] = $this->data['discount_type'] ?? 0;
                if ($season['discount_type'] == 0) {
                    $season['discount_value'] = $this->data['discount_value_price'] ?? 0;
                } else {
                    $season['discount_value'] = $this->data['discount_value_percent'] ?? 0;
                }
            }
            $attribute = $this->data['attribute'] ?? [];
            unset($this->data['attribute'], $this->data['season_id'], $this->data['discount_type'], $this->data['discount_value_price'], $this->data['discount_value_percent']);
            if ($attribute['cancel'] == 'free_before and fee_after') {
                if ($this->data['fee_type'] == 0) {
                    $fee_amount = $this->data['fee_amount_price'] ?? 0;
                } else {
                    $fee_amount = $this->data['fee_amount_percent'] ?? 0;
                }
                unset($this->data['fee_amount_price'], $this->data['fee_amount_percent']);
            } else {
                unset($this->data['fee_type'], $this->data['fee_amount_price'], $this->data['fee_amount_percent']);
            }

            $roomTypeVariant = RoomType::find($room_type_id)->variants()->create($this->data);
            if (!empty($season) && !empty($season['season_id'])) {
                $roomTypeVariant->seasons()->attach($season['season_id'], [
                    'discount_type' => $season['discount_type'],
                    'discount_value' => $season['discount_value'],
                ]);
            }
            if (!empty($attribute)) {
                foreach ($attribute as $key => $value) {
                    if ($key === 'cancel') {
                        if ($value === 'free_before and fee_after') {
                            $key = $value;
                            $value = $fee_amount ?? null;
                        } elseif ($value === 'no_refund') {
                            $key = $value;
                            $value = null;
                        }
                    }
                    $item = Attribute::where('type', $key)->first();

                    if ($item) {
                        $roomTypeVariant->attributes()->attach($item->id, ['attribute_value' => $value]);
                    }
                }
            }
            DB::commit();
            return redirect()->route($this->route['index'], ['hotel_id' => $hotel_id, 'room_type_id' => $room_type_id])->with('success', 'Thêm thành công');
        } catch (Exception $e) {
            DB::rollback();
            Log::error('Lỗi tạo RoomTypeVariant: ' . $e->getMessage());
            return redirect()->route($this->route['create'], ['hotel_id' => $hotel_id, 'room_type_id' => $room_type_id])->with('error', 'Thêm thất bại');
        }
    }

    public function edit($hotel_id, $room_type_id, $id)
    {
        $room_type = RoomType::find($room_type_id);
        $roomTypeVariant = $room_type->variants()->find($id);
        $attributes = [];
        foreach ($roomTypeVariant->attributes as $item) {
            $attributes[$item->type] = [
                'id' => $item->id,
                'name' => $item->name,
                'pivot' => $item->pivot->toArray()
            ];
        }
        //dd($attributes, $roomTypeVariant->seasons->toArray(), $roomTypeVariant->toArray());
        return view($this->view['edit'], [
            'breadcrumbs' => $this->crums->add(
                __('Danh sách biến thể'),
                route($this->route['index'], ['hotel_id' => $hotel_id, 'room_type_id' => $room_type_id])
            )->add('Cập nhập thông tin biến thể'),
            'room_type' => $room_type,
            'room_type_variant' => $roomTypeVariant,
            'attributes' => $attributes,
        ]);
    }

    public function update($hotel_id, $room_type_id, RoomTypeVariantRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->data = $request->validated();
            $this->data['status'] = $this->data['status'] ?? RoomTypeVariantStatus::Inactive->value;
            $this->data['room_type_id'] = $room_type_id;
            $this->data['discount_price'] = $this->data['discount_price'] > 0 ? $this->data['discount_price'] : null;
            $season = [];
            $season['season_id'] = $this->data['season_id'] ?? null;
            if (isset($season['season_id'])) {
                $season['discount_type'] = $this->data['discount_type'] ?? 0;
                if ($season['discount_type'] == 0) {
                    $season['discount_value'] = $this->data['discount_value_price'] ?? 0;
                } else {
                    $season['discount_value'] = $this->data['discount_value_percent'] ?? 0;
                }
            }
            $attribute = $this->data['attribute'] ?? [];
            unset($this->data['attribute'], $this->data['season_id'], $this->data['discount_type'], $this->data['discount_value_price'], $this->data['discount_value_percent']);
            if ($attribute['cancel'] == 'free_before and fee_after') {
                if ($this->data['fee_type'] == 0) {
                    $fee_amount = $this->data['fee_amount_price'] ?? 0;
                } else {
                    $fee_amount = $this->data['fee_amount_percent'] ?? 0;
                }
                unset($this->data['fee_amount_price'], $this->data['fee_amount_percent']);
            } else {
                unset($this->data['fee_type'], $this->data['fee_amount_price'], $this->data['fee_amount_percent']);
            }

            $roomTypeVariant = RoomType::find($room_type_id)->variants()->find($this->data['id']);
             $roomTypeVariant->update($this->data);
            if (!empty($season['season_id'])) {
                $roomTypeVariant->seasons()->sync([
                    $season['season_id'] => [
                        'discount_type' => $season['discount_type'],
                        'discount_value' => $season['discount_value'],
                    ]
                ]);
            }
            else {
                $roomTypeVariant->seasons()->detach();
            }
            if (!empty($attribute)) {
                $data = [];
                foreach ($attribute as $key => $value) {
                    if ($key === 'cancel') {
                        if ($value === 'free_before and fee_after') {
                            $key = $value;
                            $value = $fee_amount ?? null;
                        } elseif ($value === 'no_refund') {
                            $key = $value;
                            $value = null;
                        }
                    }
                    $item = Attribute::where('type', $key)->first();
                    if ($item) {
                        $data[$item->id] = ['attribute_value' => $value];
                    }
                }
                $roomTypeVariant->attributes()->sync($data);
            }
            DB::commit();
            return redirect()->route($this->route['index'], ['hotel_id' => $hotel_id, 'room_type_id' => $room_type_id])->with('success', 'Thêm thành công');
        } catch (Exception $e) {
            DB::rollback();
            Log::error('Lỗi tạo RoomTypeVariant: ' . $e->getMessage());
            return redirect()->route($this->route['edit'], ['hotel_id' => $hotel_id, 'room_type_id' => $room_type_id, 'id' => $this->data['id']])->with('error', 'Thêm thất bại');
        }
    }
    public function delete($hotel_id, $room_type_id, $id)
    {
        DB::beginTransaction();
        try {
            $roomTypeVariant = RoomType::find($room_type_id)->variants()->find($id);
            if ($roomTypeVariant) {
                $roomTypeVariant->seasons()->detach();
                $roomTypeVariant->attributes()->detach();
                $roomTypeVariant->delete();
            }
            DB::commit();
            return redirect()->route($this->route['index'], ['hotel_id' => $hotel_id, 'room_type_id' => $room_type_id])->with('success', 'Xóa thành công');
        } catch (Exception $e) {
            DB::rollback();
            Log::error('Lỗi xóa RoomTypeVariant: ' . $e->getMessage());
            return redirect()->route($this->route['index'], ['hotel_id' => $hotel_id, 'room_type_id' => $room_type_id])->with('error', 'Xóa thất bại');
        }
    }
}
