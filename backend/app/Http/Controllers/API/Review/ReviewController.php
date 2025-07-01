<?php

namespace App\Http\Controllers\API\Review;

use App\Enums\Booking\BookingStatus;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Review;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    public function check_review(Request $request)
    {
        $userId = $request->user_id;

        $hasBooking = Booking::where('customer_id', $userId)
            ->where('hotel_id', $request->hotel_id)
            ->where('status', \App\Enums\Booking\BookingStatus::CheckedOut->value)
            ->whereDoesntHave('review')
            ->exists();

        if (!$hasBooking) {
            return response()->json([
                'message' => 'Người dùng không đủ điều kiện để đánh giá khách sạn.',
                'data' => false,
            ], 403);
        }

        return response()->json([
            'message' => 'Người dùng có thể đánh giá khách sạn.',
            'data' => true,
        ], 200);
    }

    public function create(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'hotel_id' => 'required|exists:hotels,id',
                'star'   => 'required|integer|min:1|max:5',
                'content'  => 'nullable|string|max:1000',
            ]);

            $booking = Booking::where('hotel_id', $request->hotel_id)
                ->where('customer_id', $request->user_id)
                ->where('status', BookingStatus::CheckedOut->value)
                ->whereDoesntHave('review')
                ->latest('checkout_date')
                ->first();

            if (!$booking) {
                return response()->json([
                    'message' => 'Bạn không có đơn đặt phòng đủ điều kiện để đánh giá.',
                ], 403);
            }

            $review = Review::create([
                'hotel_id'   => $request->hotel_id,
                'booking_id' => $booking->id,
                'user_id'    => $request->user_id,
                'star'     => $request->star,
                'content'    => $request->content,
            ]);

            DB::commit();
            return response()->json([
                'message' => 'Đánh giá đã được gửi thành công.',
                'data'    => true,
            ], 201);
        } catch (Exception $e) {
            DB::rollback();
            Log::error('Lỗi thêm khách sạn: ' . $e->getMessage());
            return response()->json([
                'message' => 'Đánh giá không được gửi thành công.',
                'data' => false
            ], 500);
        }
    }
}
