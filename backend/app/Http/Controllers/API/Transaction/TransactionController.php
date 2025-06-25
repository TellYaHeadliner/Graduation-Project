<?php

namespace App\Http\Controllers\API\Transaction;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Transaction\TransactionRequest;
use App\Models\Booking;
use App\Models\Combo;
use App\Models\HotelService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{
    public function create_booking(TransactionRequest $request)
    {
        return response()->json([
            'data' => $request->all()
        ], 200);
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
            Log::error('attachCombosAndCalcTotal: ' . $e->getMessage(), [
                'booking_id' => $booking->id,
                'items'      => $items,
            ]);
            return [
                'success' => false,
                'message' => 'Có lỗi khi gắn services: ' . $e->getMessage(),
            ];
        }
    }
    public function attachRoomTypeAndCalcTotal(Booking $booking,array $items , $checkin , $checkout){
        try{
            $total = 0;
            

        } catch (Exception $e) {
            Log::error('attachCombosAndCalcTotal: ' . $e->getMessage(), [
                'booking_id' => $booking->id,
                'items'      => $items,
            ]);
            return [
                'success' => false,
                'message' => 'Có lỗi khi gắn services: ' . $e->getMessage(),
            ];
        }
    }
}
