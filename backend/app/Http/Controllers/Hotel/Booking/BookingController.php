<?php

namespace App\Http\Controllers\Hotel\Booking;

use App\DataTables\Hotel\Booking\BookingDataTable;
use App\Enums\Booking\BookingStatus;
use App\Enums\Transaction\TransactionType;
use App\Enums\Transaction\TransactionStatus;
use App\Http\Controllers\Controller;
use App\Mail\BookingCancelMail;
use App\Mail\BookingCheckInMail;
use App\Mail\BookingCheckOutMail;
use App\Mail\BookingNoShowMail;
use App\Models\Booking;
use App\Models\CommissionRule;
use App\Models\Hotel;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getView()
    {
        return [
            'index' => 'hotel.booking.index',
            'edit' => 'hotel.booking.edit',
        ];
    }
    public function getRoute(): array
    {
        return [
            'index' => 'hotel.booking.index',
            'edit' => 'hotel.booking.edit',
        ];
    }
    public function index($hotel_id, BookingDataTable $dataTable)
    {
        $hotel = Hotel::find($hotel_id);

        return $dataTable->with('hotel', $hotel)->render($this->view['index'], [
            'breadcrumbs' => $this->crums->add(__('Danh sách booking'))
        ]);
    }

    public function edit($hotel_id, $id)
    {
        $booking = Booking::find($id);

        $booking->load([
            'hotel',
            'user',
            'bookingDetails.roomType',
            'bookingDetails.variant.attributes',
            'bookingServices.hotelService.service',
            'bookingCombos.combo',
            'voucher'
        ]);


        $checkin = Carbon::parse($booking->checkin_date)->startOfDay();
        $checkout = Carbon::parse($booking->checkout_date)->startOfDay();

        $nights = $checkin->diffInDays($checkout);

        $roomTotal = 0;
        foreach ($booking->bookingDetails as $detail) {
            $roomTotal += $detail->price_per_room * $nights;
        }

        $serviceTotal = 0;
        foreach ($booking->bookingServices as $item) {
            $serviceTotal += $item->hotelService->discount_price ?: $item->hotelService->base_price;
        }

        $comboTotal = 0;
        foreach ($booking->bookingCombos as $item) {
            $comboTotal += $item->total_price;
        }

        $voucherDiscount = 0;
        $total = $booking->total_amount;

        if ($booking->voucher) {
            $v = $booking->voucher;
            if ($v->discount_type == 0) {
                $voucherDiscount = $v->discount_value;
            } else {
                $percentDiscount = $total * ($v->discount_value / 100);
                $maxDiscount = $v->max_discount_value ?? $percentDiscount;
                $voucherDiscount = min($percentDiscount, $maxDiscount);
            }
        }

        $booking->nights = $nights;
        $booking->room_total = $roomTotal;
        $booking->service_total = $serviceTotal;
        $booking->combo_total = $comboTotal;
        $booking->voucher_discount = $voucherDiscount;


        return view($this->view['edit'], [
            'breadcrumbs' => $this->crums->add(('Danh sách booking'), route($this->route['index'], [$hotel_id]))->add('Chi tiết booking'),
            'booking' => $booking,
            'BookingStatus' => \App\Enums\Booking\BookingStatus::asSelectArray(),
        ]);
    }

    public function update($hotel_id, Request $request)
    {
        DB::beginTransaction();
        try {
            $booking = Booking::find($request->id);
            $hotel = Hotel::find($hotel_id);
            $booking->loadMissing(['user', 'hotel', 'hotel.hotelRule', 'bookingDetails.roomType']);

            if (!$booking) {
                return back()->with('error', 'Đơn đặt phòng không tồn tại');
            }

            if (in_array($booking->status, [BookingStatus::Cancelled, BookingStatus::Refunded])) {
                return back()->with('error', 'Không thể cập nhật đơn đã hủy hoặc đã hoàn tiền');
            }


            if ($request->status < $booking->status->value) {
                return redirect()->route($this->route['edit'], ['hotel_id' => $hotel_id, 'id' => $request->id])
                    ->with('error', 'Không thể cập nhập từ ' . \App\Enums\Booking\BookingStatus::getDescription($request->status) . ' trở về ' . $booking->status->description());
            };
            if ($request->status == BookingStatus::Refunded->value) {
                return redirect()->route($this->route['edit'], ['hotel_id' => $hotel_id, 'id' => $request->id])
                    ->with('error', 'Không thể cập nhập trạng thái này');
            }

            if ($request->status == BookingStatus::CheckedIn->value) {
                if (now()->lt($booking->check_in)) {
                    return back()->with('error', 'Không thể check-in trước ngày nhận phòng');
                }
                $booking->update([
                    'status' => $request->status,
                    'check_in_at' => now()
                ]);
                Mail::to($booking->user->email)->send(new BookingCheckInMail($booking));
            }
            if ($request->status == BookingStatus::NoShow->value) {
                if (now()->lt($booking->check_in)) {
                    return back()->with('error', 'Không thể cập nhật vắng mặt trước ngày nhận phòng');
                }
                if (in_array($booking->status, [BookingStatus::CheckedOut, BookingStatus::Cancelled])) {
                    return back()->with('error', 'Booking này không thể cập nhật vắng mặt được nữa.');
                }

                $total_amount = $booking->total_amount;
                $commission = CommissionRule::where('is_active', true)
                    ->where('min_amount', '<=', $booking->total_amount)
                    ->where(function ($q) use ($total_amount) {
                        $q->where('max_amount', '>=', $total_amount)
                            ->orWhereNull('max_amount');
                    })->orderBy('min_amount', 'desc')
                    ->value('commission_percent') ?? 0.0;
                $total_release = $booking->total_amount - ($booking->total_amount * $commission / 100);
                $user = User::where('email', 'admin@gmail.com')->first();
                Transaction::create([
                    'booking_id' => $booking->id,
                    'hotel_id' => $hotel->id,
                    'user_id' => $user->id,
                    'transaction_type' => TransactionType::Release->value,
                    'transaction_code' => 'RMX' . now()->format('YmdHis') . strtoupper(Str::random(4)),
                    'amount' => $total_release,
                    'commission_amount' => $booking->total_amount * $commission / 100,
                    'payment_status' => TransactionStatus::Success->value,
                    'paid_at' => now(),
                ]);

                $booking->update([
                    'status' => $request->status,
                ]);
                Mail::to($booking->user->email)->send(new BookingNoShowMail($booking));
            }

            if ($request->status == BookingStatus::CheckedOut->value) {
                if ($booking->status != BookingStatus::CheckedIn) {
                    return back()->with('error', 'Chỉ có thể Check-out sau khi Check-in');
                }
                $total_amount = $booking->total_amount;
                $commission = CommissionRule::where('is_active', true)
                    ->where('min_amount', '<=', $booking->total_amount)
                    ->where(function ($q) use ($total_amount) {
                        $q->where('max_amount', '>=', $total_amount)
                            ->orWhereNull('max_amount');
                    })->orderBy('min_amount', 'desc')
                    ->value('commission_percent') ?? 0.0;
                $total_release = $booking->total_amount - ($booking->total_amount * $commission / 100);
                $user = User::where('email', 'admin@gmail.com')->first();
                Transaction::create([
                    'booking_id' => $booking->id,
                    'hotel_id' => $hotel->id,
                    'user_id' => $user->id,
                    'transaction_type' => TransactionType::Release->value,
                    'transaction_code' => 'RMX' . now()->format('YmdHis') . strtoupper(Str::random(4)),
                    'amount' => $total_release,
                    'commission_amount' => $booking->total_amount * $commission / 100,
                    'payment_status' => TransactionStatus::Success->value,
                    'paid_at' => now(),
                ]);

                $booking->update([
                    'status' => $request->status,
                    'check_out_at' => now()
                ]);
                Mail::to($booking->user->email)->send(new BookingCheckOutMail($booking));
            }

            if ($request->status == BookingStatus::Cancelled->value) {
                if ($booking->status == BookingStatus::CheckedOut || $booking->status == BookingStatus::CheckedIn) {
                    return back()->with('error', 'Không thể hủy sau khi check in hoặc check out');
                }
                $tienTra = 0;
                $tienGiu = 0;
                $nights = Carbon::parse(format_date($booking->checkin_date, 'd-m-Y'))->diffInDays(Carbon::parse(format_date($booking->checkout_date, 'd-m-Y')));
                $nights = max($nights, 1);
                $booking->load([
                    'bookingDetails.variant.attributes',
                    'bookingCombos',
                    'bookingServices'
                ]);
                $hoursGap = now()->diffInHours($booking->checkin_date, false);
                foreach ($booking->bookingDetails as $item) {
                    $variant = $item->variant;

                    if ($variant->attributes->firstWhere('type', 'no_refund')) {
                        $tienGiu += $item->price_per_room * $nights;
                        continue;
                    }
                    $free_before_and_fee_after = $variant->attributes->firstWhere('type', 'free_before and fee_after');
                    if ($free_before_and_fee_after) {
                        if ($hoursGap >= 24) {
                            $tienTra += $item->price_per_room * $nights;
                        } else {
                            $tienTra += ($item->price_per_room * $nights) - ($free_before_and_fee_after->pivot->attribute_value * $nights);
                            $tienGiu += min($free_before_and_fee_after->pivot->attribute_value, $item->price_per_room) * $nights;
                        }
                    }
                }

                foreach ($booking->bookingCombos as $combo) {
                    $tienTra += $combo->total_price;
                }
                foreach ($booking->bookingServices as $item) {
                    $tienTra += $item->total_price;
                }

                $tienTra = min($tienTra, $booking->total_amount - $tienGiu);

                if ($tienTra + $tienGiu > $booking->total_amount) {
                    $excess = ($tienTra + $tienGiu) - $booking->total_amount;
                    $tienTra -= $excess;
                }

                if ($tienTra > 0) {
                    $giaoDichHoanTien = Transaction::create([
                        'booking_id' => $booking->id,
                        'hotel_id' => $booking->hotel_id,
                        'user_id' => $booking->customer_id,
                        'transaction_type' => TransactionType::Refund->value,
                        'transaction_code' => 'RMX' . now()->format('YmdHis') . strtoupper(Str::random(4)),
                        'amount' => $tienTra,
                        'payment_status' => TransactionStatus::Success->value,
                        'paid_at' => now(),
                    ]);
                }
                $commissionPercent = CommissionRule::where('is_active', true)
                    ->where('min_amount', '<=', $tienGiu)
                    ->where(function ($q) use ($tienGiu) {
                        $q->where('max_amount', '>=', $tienGiu)
                            ->orWhereNull('max_amount');
                    })
                    ->orderBy('min_amount', 'desc')
                    ->value('commission_percent') ?? 0;

                $payToHotel = $tienGiu - ($tienGiu * $commissionPercent / 100);

                if ($payToHotel > 0) {
                    $admin = User::where('email', 'admin@gmail.com')->first();
                    Transaction::create([
                        'booking_id' => $booking->id,
                        'hotel_id' => $booking->hotel_id,
                        'user_id' => $admin->id,
                        'transaction_type' => TransactionType::Release->value,
                        'transaction_code' => 'RMX' . now()->format('YmdHis') . strtoupper(Str::random(4)),
                        'amount' => $payToHotel,
                        'commission_amount' => $tienGiu * $commissionPercent / 100,
                        'payment_status' => TransactionStatus::Success->value,
                        'paid_at' => now(),
                    ]);
                }
                $booking->update(['status' => BookingStatus::Cancelled->value]);
                Mail::to($booking->user->email)->send(new BookingCancelMail($booking,$giaoDichHoanTien));
            }
            DB::commit();
            return redirect()->route($this->route['index'], ['hotel_id' => $hotel_id])->with('success', 'Cập nhập thành công');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->route($this->route['edit'], ['hotel_id' => $hotel_id, 'id' => $request->id])->with('error', 'Cập nhật thất bại');
        }
    }
}
