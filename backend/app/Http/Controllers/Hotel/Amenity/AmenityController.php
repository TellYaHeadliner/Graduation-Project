<?php

namespace App\Http\Controllers\Hotel\Amenity;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use App\Models\Hotel;
use Illuminate\Http\Request;

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
        $hotelAmenities = $hotel->hotelAmenities()->get();
        // dd($amenitiesTree);
        return view($this->view['index'], [
            'breadcrumbs' => $this->crums->add(__('Danh sách tiện nghi')),
            'hotel' => $hotelAmenities,
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
}
