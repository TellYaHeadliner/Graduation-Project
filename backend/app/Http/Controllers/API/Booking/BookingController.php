<?php

namespace App\Http\Controllers\API\Booking;

use App\Enums\Booking\BookingStatus;
use App\Enums\Season\SeasonStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookingDetailResource;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    private $data;
    public function __construct()
    {
        parent::__construct();
    }

    public function history(Request $request)
    {
        $bookings = Booking::with(['user', 'hotel', 'voucher'])
            ->where('customer_id', $request->user_id)
            ->when($request->status == 4, function ($query) {
                $query->where('status', 4);
            }, function ($query) {
                $query->whereIn('status', [1, 2, 3]);
            })
            ->get();

        return response()->json([
            'message' => 'lịch sử booking',
            'data' => BookingResource::collection($bookings),
        ]);
    }

    public function detail(Request $request)
    {

        $booking = Booking::with([
            'hotel',
            'voucher',
            'user:id,fullname,email,phone',

            'bookingDetails.room:id,code',
            'bookingDetails.roomType:id,name',
            'bookingDetails.variant.attributes',

            'bookingServices.hotelService.service:id,name,default_unit',

            'bookingCombos.combo:id,name',
            'bookingCombos.combo.hotelServices.service',
        ])
            ->find($request->id);

        if (!$booking) {
             return response()->json([
            'message' => 'Không tìm thấy đơn đặt',
            'data' => []
        ]);
        }

        return response()->json([
            'message' => 'Chi tiết đơn đặt phòng',
            'data' => new BookingDetailResource($booking),
        ]);
    }
}
