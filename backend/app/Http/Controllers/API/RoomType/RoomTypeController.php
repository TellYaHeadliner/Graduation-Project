<?php

namespace App\Http\Controllers\API\RoomType;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoomTypeResource;
use App\Models\RoomType;
use App\Models\RoomTypeVariant;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomTypeController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getRoomTypeHotel(Request $request)
    {
        try {
            $data = $request->query();
            $guest = $data['guest'] ?? null;
            $children = $data['children'] ?? null;
            $room_quantity = $data['room_quantity'] ?? null;
            $check_in = Carbon::parse($data['check_in'])->toDateString();
            $check_out = Carbon::parse($data['check_out'])->toDateString();
            $hotel_id = $data['hotel_id'] ?? null;


            $listRoomType = RoomType::with([
                'variants' => function ($variantQuery) use (
                    $guest,
                    $children,
                    $check_in,
                    $check_out
                ) {
                    $variantQuery
                        ->whereHas('attributes', function ($q) use ($guest) {
                            $q->where('attributes.type', 'guest')
                                ->whereRaw('CAST(variant_attributes.attribute_value AS UNSIGNED) >= ?', [$guest]);
                        })
                        ->whereHas('attributes', function ($q) use ($children) {
                            $q->where('attributes.type', 'children')
                                ->whereRaw('CAST(variant_attributes.attribute_value AS UNSIGNED) >= ?', [$children]);
                        })
                        ->with([
                            'seasons',
                            'attributes:id,name,type',
                        ]);
                },
                'amenities:id,name',
                'bedType:id,name',
            ])
                ->where('hotel_id', $hotel_id)
                ->withCount([
                    'rooms as available_room_count' => function ($q) use ($check_in, $check_out) {
                        $q->whereDoesntHave('bookingDetails.booking', function ($q) use ($check_in, $check_out) {
                            $q->where('checkin_date', '<',  $check_out)
                                ->where('checkout_date', '>', $check_in);
                        });
                    },
                ])
                ->get();
                
            return response()->json([
                'message' => 'Chi tiết loại phòng khách sạn.',
                'data' => [
                    'list' => RoomTypeResource::collection($listRoomType),
                ]
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Chi tiết loại phòng khách sạn. lỗi',
                'data' => [
                    'error' => $e->getMessage()
                ]
            ], 500);
        };
    }
}
