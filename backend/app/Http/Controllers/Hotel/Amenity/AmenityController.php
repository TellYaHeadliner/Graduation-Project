<?php

namespace App\Http\Controllers\Hotel\Amenity;

use App\Http\Controllers\Controller;
use App\Http\Requests\Hotel\Amenity\AmenityRequest;
use App\Models\Amenity;
use App\Models\Hotel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AmenityController extends Controller
{
    private $data;

    public function __construct()
    {
        parent::__construct();
    }

    public function getView(): array
    {
        return [
            'index' => 'hotel.amenity.index',
        ];
    }

    public function getRoute(): array
    {
        return [
            'index' => 'hotel.amenity.index',
            'update' => 'hotel.amenity.update'
        ];
    }

    public function index($hotel_id)
    {
        $amenities = Amenity::all();
        $groupedAmenities = $amenities->groupBy('parent_id');
        $amenitiesTree = $this->buildAmenityTree($groupedAmenities);

        $hotel = Hotel::where('id', $hotel_id)->first();
        $hotelAmenities = [];
        foreach ($hotel->amenities as $item) {
            $hotelAmenities[] = $item->id;
        }
        return view($this->view['index'], [
            'breadcrumbs' => $this->crums->add(__('Danh sách tiện nghi')),
            'hotelAmenities' => $hotelAmenities,
            'amenitiesTree' => $amenitiesTree
        ]);
    }

    public function buildAmenityTree($grouped)
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

    public function update(AmenityRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->data = $request->validated();
            $this->data['amenities'] = $this->data['amenities'] ?? [];

            $hotel = Hotel::where('id',$this->data['id'])->first();

            $hotel->amenities()->sync($this->data['amenities']);

            DB::commit();
            return redirect()->route($this->route['index'], [$this->data['id']])->with('success', 'Cập nhập thành công');
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return redirect()->route($this->route['index'], [$this->data['id']])->with('error', 'Cập nhập thất bại');
        }
    }
}
