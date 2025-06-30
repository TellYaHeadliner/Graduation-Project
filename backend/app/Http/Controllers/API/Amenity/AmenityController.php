<?php

namespace App\Http\Controllers\API\Amenity;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use Illuminate\Http\Request;

class AmenityController extends Controller
{
    public function listAmenity()
    {

        $grouped = Amenity::all()->groupBy('parent_id');

        $amenities = $this->buildAmenityTree($grouped);

        return response()->json([
            'message' => 'Danh sách tiện nghi',
            'data' => $amenities
        ], 200);
    }

    public static function buildAmenityTree($grouped, $parentId = null)
    {
        $result = [];

        if (!isset($grouped[$parentId])) {
            return $result;
        }

        foreach ($grouped[$parentId] as $amenity) {
            $children = self::buildAmenityTree($grouped, $amenity->id);

            $result[] = [
                'id' => $amenity->id,
                'name' => $amenity->name,
                'children' => $children
            ];
        }

        return $result;
    }
}
