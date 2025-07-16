<?php

namespace App\Http\Controllers\API\RoomType;

use App\Enums\Booking\BookingStatus;
use App\Enums\RoomType\RoomTypeStatus;
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
                'variants' => function ($variantQuery) use ($guest, $children, $check_in, $check_out) {
                    $variantQuery->with([
                        'seasons',
                        'attributes:id,name,type',
                    ]);
                },
                'amenities:id,name',
                'bedType:id,name',
            ])
                ->where('hotel_id', $hotel_id)
                ->whereHas('variants', function ($q) use ($guest, $children) {
                    $q->whereHas('attributes', function ($q1) use ($guest) {
                        $q1->where('attributes.type', 'guest')
                            ->whereRaw('CAST(variant_attributes.attribute_value AS UNSIGNED) >= ?', [$guest]);
                    })->whereHas('attributes', function ($q2) use ($children) {
                        $q2->where('attributes.type', 'children')
                            ->whereRaw('CAST(variant_attributes.attribute_value AS UNSIGNED) >= ?', [$children]);
                    });
                })
                ->withCount([
                    'rooms as available_room_count' => function ($q) use ($check_in, $check_out) {
                        $q->whereDoesntHave('bookingDetails', function ($d) use ($check_in, $check_out) {
                            $d->whereHas('booking', function ($b) use ($check_in, $check_out) {
                                $b->where('checkin_date', '<',  $check_out)
                                    ->where('checkout_date', '>', $check_in)
                                    ->whereIn('status', [
                                        BookingStatus::Pending->value,
                                        BookingStatus::Confirmed->value,
                                        BookingStatus::CheckedIn->value,
                                    ]);
                            });
                        });
                    }
                ])
                ->where('status', RoomTypeStatus::Active)
                ->when($room_quantity, function ($q) use ($room_quantity) {
                    $q->having('available_room_count', '>=', $room_quantity);
                })
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
