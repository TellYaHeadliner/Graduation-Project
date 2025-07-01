<?php

namespace App\Http\Controllers\Admin\Booking;

use App\DataTables\Admin\Booking\BookingDataTable;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    private $data;

    public function __construct()
    {
        parent::__construct();
    }

    public function getView()
    {
        return [
            'index' => 'admin.booking.index',
            'edit' => 'admin.booking.edit',
        ];
    }
    public function getRoute(): array
    {
        return [
            'index' => 'admin.booking.index',
            'edit' => 'admin.booking.edit',
        ];
    }
    public function index(BookingDataTable $dataTable)
    {
        return $dataTable->render($this->view['index'], [
            'breadcrumbs' => $this->crums->add(__('Danh sách booking'))
        ]);
    }

    public function edit($id)
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
            'breadcrumbs' => $this->crums->add(('Danh sách booking'), route($this->route['index']))->add('Chi tiết booking'),
            'booking' => $booking,
        ]);
    }
}
