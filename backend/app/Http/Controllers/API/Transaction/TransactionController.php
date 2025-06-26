<?php

namespace App\Http\Controllers\API\Transaction;

use App\Enums\Booking\BookingStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Transaction\TransactionRequest;
use App\Models\Booking;
use App\Models\Combo;
use App\Models\HotelService;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\RoomTypeVariant;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class TransactionController extends Controller
{
    public function create_booking(TransactionRequest $request)
    {
        DB::beginTransaction();
        try {
            $booking = Booking::create([
                'customer_id' => $request->user_id,
                'hotel_id' => $request->hotel_id,
                'booking_code' => 'RMX' . now()->format('Ymd') . Str::upper(Str::random(6)),
                'total_amount' => 0,
                'checkin_date' => $request->checkin_date,
                'checkout_date' => $request->checkout_date,
                'note' => $request->note ?? '',
                'status' => BookingStatus::Pending->value,
            ]);
            $create_room = $this->attachRoomTypeAndCalcTotal($booking, $request->booking_details);
            if (!$create_room['success']) {
                return response()->json([
                    'message' => $create_room['message'] ?? 'Lỗi tạo phòng',
                ], 500);
            }

            if ($request->booking_combos && !empty($request->booking_combos)) {
                $combos = $this->attachCombosAndCalcTotal($booking, $request->booking_combos);
                if (!$combos['success']) {
                    return response()->json([
                        'message' => $combos['message'] ?? 'Có lỗi khi gắn combo'
                    ], 500);
                }
            }
            if ($request->booking_services && !empty($request->booking_services)) {
                $services = $this->attachHotelServicesAndCalcTotal($booking, $request->booking_services);
                if (!$services['success']) {
                    return response()->json([
                        'message' => $services['message'] ?? 'Có lỗi khi gắn combo'
                    ], 500);
                }
            }

            $total = ($combos['total'] ?? 0) + ($services['total'] ?? 0) + $booking->bookingDetails->sum('price_per_room');
            $booking->update(['total_amount' => $total]);

            
            DB::commit();
            return response()->json([
                'message' => 'tạo thành công đơn hàng chuẩn bị thanh toán.'
            ], 200);
        } catch (Exception $e) {
            DB::rollback();
            Log::error('create booking: ' . $e->getMessage(), []);
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function attachCombosAndCalcTotal(Booking $booking, array $items)
    {
        try {
            $comboIds = array_column($items, 'combo_id');
            $comboMap = Combo::whereIn('id', $comboIds)
                ->get()->keyBy('id');

            $total = 0;
            $pivotData = [];

            foreach ($items as $item) {
                $id  = (int) $item['combo_id'];
                $qty = max(1, (int) $item['quantity']);

                if (! isset($comboMap[$id])) {
                    continue;
                }

                $price    = $comboMap[$id]->combo_price;
                $subtotal = $price * $qty;
                $total   += $subtotal;

                $pivotData[$id] = [
                    'quantity'    => $qty,
                    'price'       => $price,
                    'total_price' => $subtotal,
                ];
            }

            DB::transaction(function () use ($booking, $pivotData) {
                $booking->combos()
                    ->attach($pivotData);
            });

            return [
                'success' => true,
                'total'   => $total,
            ];
        } catch (Exception $e) {
            Log::error('attachCombosAndCalcTotal: ' . $e->getMessage(), [
                'booking_id' => $booking->id,
                'items'      => $items,
            ]);
            return [
                'success' => false,
                'message' => 'Có lỗi khi gắn combo: ' . $e->getMessage(),
            ];
        }
    }
    public function attachHotelServicesAndCalcTotal(Booking $booking, array $items)
    {
        try {
            $hotelServiceIds = array_column($items, 'hotel_service_id');
            $hotelServiceMap = HotelService::whereIn('id', $hotelServiceIds)
                ->get()->keyBy('id');

            $total = 0;
            $pivotData = [];

            foreach ($items as $item) {
                $id  = (int) $item['hotel_service_id'];
                $qty = max(1, (int) $item['quantity']);

                if (! isset($hotelServiceMap[$id])) {
                    continue;
                }

                $price    = $hotelServiceMap[$id]->promo_price ?: $hotelServiceMap[$id]->base_price;
                $subtotal = $price * $qty;
                $total   += $subtotal;

                $pivotData[$id] = [
                    'quantity'    => $qty,
                    'price'       => $price,
                    'total_price' => $subtotal,
                ];
            }

            DB::transaction(function () use ($booking, $pivotData) {
                $booking->hotelServices()
                    ->attach($pivotData);
            });

            return [
                'success' => true,
                'total'   => $total,
            ];
        } catch (Exception $e) {
            Log::error('attachHotelServiceAndCalcTotal: ' . $e->getMessage(), [
                'booking_id' => $booking->id,
                'items'      => $items,
            ]);
            return [
                'success' => false,
                'message' => 'Có lỗi khi gắn services: ' . $e->getMessage(),
            ];
        }
    }
    public function attachRoomTypeAndCalcTotal(Booking $booking, array $items)
    {
        DB::beginTransaction();
        try {
            $cancellation_fee = 0;
            foreach ($items as $item) {
                $rooms = Room::where('room_type_id', $item['room_type_id'])
                    ->whereDoesntHave('bookingDetails.booking', function ($q) use ($booking) {
                        $q->where('checkin_date', '<',  $booking->checkout_date)
                            ->where('checkout_date', '>', $booking->checkin_date);
                    })
                    ->orderBy('code', 'asc')
                    ->limit($item['quantity'])
                    ->get();

                if ($rooms->count() < $item['quantity']) {
                    DB::rollBack();
                    return [
                        'success' => false,
                        'message' => "Yêu cầu xem lại chính xác số lượng phòng."
                    ];
                }

                $roomVariant = RoomTypeVariant::with(['seasons', 'attributes'])->find($item['room_type_variant_id']);
                if (!$roomVariant) {
                    DB::rollBack();
                    return ['success' => false, 'message' => 'Không tìm thấy biến thể phòng.'];
                }
                $price = $roomVariant->discount_price ?: $roomVariant->base_price;

                $season = $roomVariant->seasons->where('status', 1)->first();

                if ($season) {
                    if ($season->pivot->discount_type == 0) {
                        $price -= $season->pivot->discount_value;
                    } else {
                        $price -= $price * ($season->pivot->discount_value / 100);
                    }
                }
                $price = max(0, $price);

                if (!empty($roomVariant->attributes)) {
                    $fee_cancel = $roomVariant->attributes->firstWhere('type', 'free_before and fee_after');
                    if ($fee_cancel) {
                        $cancellation_fee += $fee_cancel->pivot->attribute_value * $item['quantity'];
                    }
                }


                foreach ($rooms as $room) {
                    $booking->bookingDetails()->create([
                        'room_type_id'         => $item['room_type_id'],
                        'room_type_variant_id' => $item['room_type_variant_id'],
                        'room_id'              => $room->id,
                        'price_per_room'       => $price
                    ]);
                }
            };
            $booking->update([
                'cancellation_fee' => $cancellation_fee
            ]);
            DB::commit();
            return [
                'success' => true,
            ];
        } catch (Exception $e) {
            DB::rollback();
            Log::error('attachRoomTypeAndCalcTotal: ' . $e->getMessage(), [
                'booking_id' => $booking->id,
                'items'      => $items,
            ]);
            return [
                'success' => false,
                'message' => 'Có lỗi khi gắn room: ' . $e->getMessage(),
            ];
        }
    }
}
