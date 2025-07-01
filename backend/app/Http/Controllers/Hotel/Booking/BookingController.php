<?php

namespace App\Http\Controllers\Hotel\Booking;

use App\DataTables\Hotel\Booking\BookingDataTable;
use App\Enums\Booking\BookingStatus;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\CommissionRule;
use App\Models\Hotel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Log;

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
            if ($request->status < $booking->status->value) {
                return redirect()->route($this->route['edit'], ['hotel_id' => $hotel_id, 'id' => $request->id])
                    ->with('error', 'Không thể cập nhập từ ' . \App\Enums\Booking\BookingStatus::getDescription($request->value) . ' xuống' . $booking->status->description());
            };
            if ($request->status == BookingStatus::Refunded->value) {
                return redirect()->route($this->route['edit'], ['hotel_id' => $hotel_id, 'id' => $request->id])
                    ->with('error', 'Không thể cập nhập trạng thái này');
            }

            if ($request->status == BookingStatus::CheckedIn->value) {
                $booking->update([
                    'status' => $request->status
                ]);
                // gửi mail thông báo checkin thành công
            }
            if ($request->status == BookingStatus::CheckedOut->value) {
                $total_amount = $booking->total_amount;
                $commission = CommissionRule::where('is_active', true)
                    ->where('min_amount', '<=', $booking->total_amount)
                    ->where(function ($q) use ($total_amount) {
                        $q->where('max_amount', '>=', $total_amount)
                            ->orWhereNull('max_amount');
                    })->orderBy('min_amount', 'desc')
                    ->value('commission_percent') ?? 0.0;

                // gửi mail thông báo checkout thành công và chuyển tiền cho khách sạn
            }
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->route($this->route['edit'], ['hotel_id' => $hotel_id, 'id' => $request->id])->with('error', 'Cập nhật thất bại');
        }
    }
}
