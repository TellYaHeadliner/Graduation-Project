<?php

namespace App\Http\Controllers\API\Transaction;

use App\Enums\Booking\BookingStatus;
use App\Enums\Transaction\TransactionStatus;
use App\Enums\Transaction\TransactionType;
use App\Enums\Voucher\VoucherStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Transaction\TransactionRequest;
use App\Mail\BookingSuccessMail;
use App\Models\Booking;
use App\Models\Combo;
use App\Models\HotelService;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\RoomTypeVariant;
use App\Models\Transaction;
use App\Models\Voucher;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class TransactionController extends Controller
{
    public function create_booking(TransactionRequest $request)
    {
        DB::beginTransaction();
        try {

            $combos = ['total' => 0];
            $services = ['total' => 0];

            if (Booking::where('customer_id', $request->user_id)
                ->where('checkin_date', '<',  $request->checkout_date)
                ->where('checkout_date', '>', $request->checkin_date)
                ->whereIn('status', [
                    BookingStatus::Pending->value,
                    BookingStatus::Confirmed->value,
                    BookingStatus::CheckedIn->value,
                ])->exists()
            ) {
                return response()->json([
                    'message' => 'Không thể đặt booking mới vì bạn đã có một booking trong thời gian này',
                    'data' => []
                ]);
            }


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
            $booking->loadMissing([
                'bookingDetails.Variant.roomType',
                'bookingServices.hotelService',
                'bookingCombos.combo',
                'voucher',
            ]);

            $nights = Carbon::parse($booking->checkout_date)->diffInDays(Carbon::parse($booking->checkin_date));
            $nights = max($nights, 1);

            $roomTotal = $booking->bookingDetails
                ->map(function ($detail) use ($nights) {
                    $price = is_numeric($detail->price_per_room) ? $detail->price_per_room : 0;
                    return $price * $nights;
                })
                ->sum();

            $total = ($combos['total'] ?? 0) + ($services['total'] ?? 0) + $roomTotal;

            if ($request->filled('voucher_id')) {
                $voucher = $this->checkVoucher($request->voucher_id, $total);
                if (!$voucher['success']) {
                    return response()->json([
                        'message' => $voucher['message']
                    ], 500);
                }

                $v = $voucher['data'];
                if ($v->discount_type == 0) {
                    $total -= $v->discount_value;
                } else {
                    $percentDiscount = $total * ($v->discount_value / 100);
                    $maxDiscount     = $v->max_discount_value ?? $percentDiscount;
                    $total          -= min($percentDiscount, $maxDiscount);
                }
                $booking->voucher_id = $v->id;
            }
            $total = max(0, $total);
            $booking->total_amount = $total;
            $booking->save();

            $transaction = Transaction::create([
                'booking_id' => $booking->id,
                'hotel_id' => $request->hotel_id,
                'user_id' => $request->user_id,
                'transaction_type' => TransactionType::Holding->value,
                'transaction_code' => 'RMX' . now()->format('YmdHis') . strtoupper(Str::random(4)),
                'amount' => $total,
                'payment_status' => TransactionStatus::Processing->value
            ]);

            $vnp_TxnRef = $transaction->transaction_code; //Mã giao dịch thanh toán tham chiếu của merchant
            $vnp_Amount = $total;
            $vnp_Locale = "vn"; //Ngôn ngữ chuyển hướng thanh toán
            $vnp_BankCode = ""; //Mã phương thức thanh toán
            $vnp_IpAddr = request()->ip(); //IP Khách hàng thanh toán
            $startTime = date("YmdHis");
            $expire = date('YmdHis', strtotime('+5 minutes', strtotime($startTime)));

            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => env('vnp_TmnCode'),
                "vnp_Amount" => $vnp_Amount * 100,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => 'Đơn hàng #' . $booking->booking_code . ' - Khách hàng: ' . $booking->user->full_name,
                "vnp_OrderType" => "other",
                "vnp_ReturnUrl" => env('vnp_Returnurl'),
                "vnp_TxnRef" => $vnp_TxnRef,
                "vnp_ExpireDate" => $expire,
            );

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }

            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = env('vnp_Url') . "?" . $query;
            if (env('vnp_HashSecret')) {
                $vnpSecureHash =   hash_hmac('sha512', $hashdata, env('vnp_HashSecret')); //  
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            DB::commit();
            return response()->json([
                'message' => 'Chuyển sang trang thanh toán',
                'url' => $vnp_Url
            ], 200);
        } catch (Exception $e) {
            DB::rollback();
            Log::error('create booking: ' . $e->getMessage(), []);
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function callback_vnpay(Request $request)
    {
        $data = $request->all();
        $transaction = Transaction::with('booking')->where('transaction_code', $data['vnp_TxnRef'])->first();
        if ($data['vnp_ResponseCode'] == '00') {

            $transaction->update([
                'payment_status' => TransactionStatus::Success->value,
                'paid_at' => now(),
            ]);

            $transaction->booking->update([
                'status' => BookingStatus::Confirmed->value,
            ]);

            $booking = $transaction->booking;

            $booking->loadMissing(['user', 'hotel', 'hotel.hotelRule']);

            Mail::to($booking->user->email)->send(new BookingSuccessMail($booking));

            return redirect()->away('http://127.0.0.1:5173/lich-su-booking?status=success&message=' . urlencode('Thanh toán thành công'));
        } else {
            $transaction->booking->delete();
            $transaction->update([
                'payment_status' => TransactionStatus::Failed->value,
                'paid_at' => now(),
            ]);
            return redirect()->away('http://127.0.0.1:5173/lich-su-booking?status=error&message=' . urlencode('Thanh toán không thành công'));
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
                            ->where('checkout_date', '>', $booking->checkin_date)
                            ->whereIn('status', [
                                BookingStatus::Pending->value,
                                BookingStatus::Confirmed->value,
                                BookingStatus::CheckedIn->value,
                                BookingStatus::CheckedOut->value,
                            ]);
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

    public function checkVoucher($voucher_id, $total_amount)
    {
        $voucher = Voucher::find($voucher_id);

        if (!$voucher) {
            return ['success' => false, 'message' => 'Voucher không tồn tại'];
        }

        if ($voucher->is_active != VoucherStatus::Active) {
            return ['success' => false, 'message' => 'Voucher hiện không thể áp dụng'];
        }

        $now = now();
        if ($voucher->start_date > $now || $voucher->end_date < $now) {
            return ['success' => false, 'message' => 'Voucher đã hết hạn hoặc chưa bắt đầu'];
        }

        if ($total_amount < $voucher->min_order_value) {
            return ['success' => false, 'message' => 'Không đủ điều kiện áp dụng'];
        }

        return ['success' => true, 'data' => $voucher];
    }
}
