<?php

namespace App\Http\Controllers\API\Hotel;

use App\Enums\Season\SeasonStatus;
use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function listHotelSeasons(Request $request)
    {
        $name = $request->query('name');
        $hotels = Hotel::whereHas('roomTypes.variants.seasons', function ($query) use ($name) {
            $query->where('status', SeasonStatus::Active->value);
            if ($name) {
                $query->where('name', 'LIKE', '%' . $name . '%');
            }
        })->with(['roomTypes.variants.seasons'])
            ->get();
        return response()->json([
            'message' => 'Danh sách khách sạn có ưu đãi.',
            'data' => [
                'hotels' => $hotels
            ]
        ],200);
    }
    public function detailHotel(Request $request)
    {
        $id = $request->query('id');
        $hotel = Hotel::with([
            'roomTypes.variants.seasons',
            'hotelRule'
        ])->find($id);
        return response()->json([
            'message' => 'Chi tiết khách sạn.',
            'data' => [
                'hotel' => $hotel
            ]
        ],200);
    }
}
