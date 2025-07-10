<?php

namespace App\Http\Controllers\Hotel\Dashboard;

use App\Enums\Booking\BookingStatus;
use App\Enums\Transaction\TransactionStatus;
use App\Enums\Transaction\TransactionType;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }


    public function getView()
    {
        return [
            'index' => 'hotel.dashboard.index',
        ];
    }
    public function index()
    {
        $hotelId = auth()->user()->hotel->id;

        $summary = [
            'total_rooms'       => DB::table('rooms')->where('hotel_id', $hotelId)->count(),
            'total_bookings'    => DB::table('bookings')->where('hotel_id', $hotelId)->count(),
            'success_bookings'  => DB::table('bookings')
                ->where('hotel_id', $hotelId)
                ->where('status', BookingStatus::CheckedOut->value)
                ->count(),
            'gross_revenue'     => DB::table('bookings')
                ->where('hotel_id', $hotelId)
                ->where('status', BookingStatus::CheckedOut->value)
                ->sum('total_amount'),
            'net_revenue'       => DB::table('transactions')
                ->join('bookings', 'transactions.booking_id', '=', 'bookings.id')
                ->where('bookings.hotel_id', $hotelId)
                ->where('transactions.transaction_type', TransactionType::Release->value)
                ->where('transactions.payment_status', TransactionStatus::Success->value)
                ->sum(DB::raw('transactions.amount')),
        ];

        return view($this->view['index'])->with('summary', $summary);
    }

    public function data(Request $request)
    {
        $from    = Carbon::parse($request->input('from', now()->subMonths(12)->startOfMonth()));
        $to      = Carbon::parse($request->input('to',   now()->endOfMonth()));
        $groupBy = $request->input('group_by', 'month');

        $format = match ($groupBy) {
            'day'  => '%Y-%m-%d',
            'year' => '%Y',
            default => '%Y-%m',
        };

        $hotelId = auth()->user()->hotel->id;

        $bookingStats = DB::table('bookings')
            ->selectRaw("
            DATE_FORMAT(created_at, '{$format}') as time,
            COUNT(*) as total,
            SUM(CASE WHEN status = ? THEN 1 ELSE 0 END) as success
        ", [BookingStatus::CheckedOut->value])
            ->where('hotel_id', $hotelId)
            ->groupBy('time')
            ->orderBy('time')
            ->get();

        $bookingChart = [
            'labels' => $bookingStats->pluck('time'),
            'datasets' => [
                [
                    'label' => 'Tổng booking',
                    'data'  => $bookingStats->pluck('total'),
                    'backgroundColor' => 'rgba(59,130,246,0.5)',
                ],
                [
                    'label' => 'Thành công',
                    'data'  => $bookingStats->pluck('success'),
                    'backgroundColor' => 'rgba(16,185,129,0.5)',
                ],
            ]
        ];

        $revenue = DB::table('bookings')
            ->leftJoin('transactions', function ($join) {
                $join->on('transactions.booking_id', '=', 'bookings.id')
                    ->where('transactions.transaction_type', TransactionType::Release->value)
                    ->where('transactions.payment_status', TransactionStatus::Success->value);
            })
            ->selectRaw("
            DATE_FORMAT(bookings.created_at, '{$format}') AS time,
            SUM(bookings.total_amount) AS gross,
            SUM(transactions.amount) AS net
        ")
            ->where('bookings.hotel_id', $hotelId)
            ->where('bookings.status', BookingStatus::CheckedOut->value)
            ->whereBetween('bookings.created_at', [$from, $to])
            ->groupBy('time')
            ->orderBy('time')
            ->get();

        $revenueChart = [
            'labels' => $revenue->pluck('time'),
            'datasets' => [
                [
                    'label' => 'Doanh thu gộp',
                    'data'  => $revenue->pluck('gross'),
                    'borderColor' => '#3b82f6',
                    'backgroundColor' => 'rgba(59,130,246,0.2)',
                ],
                [
                    'label' => 'Doanh thu thực',
                    'data'  => $revenue->pluck('net'),
                    'borderColor' => '#10b981',
                    'backgroundColor' => 'rgba(16,185,129,0.2)',
                ],
            ]
        ];

        $topRoomTypes = DB::table('booking_details')
            ->join('bookings', 'booking_details.booking_id', '=', 'bookings.id')
            ->join('room_types', 'booking_details.room_type_id', '=', 'room_types.id')
            ->where('bookings.hotel_id', $hotelId)
            ->where('bookings.status', BookingStatus::CheckedOut->value)
            ->selectRaw('room_types.name, SUM(booking_details.price_per_room) AS revenue')
            ->groupBy('room_types.id', 'room_types.name')
            ->orderByDesc('revenue')
            ->limit(5)
            ->get();

        $topRoomRevenueChart = [
            'labels' => $topRoomTypes->pluck('name'),
            'datasets' => [[
                'label' => 'Doanh thu',
                'data' => $topRoomTypes->pluck('revenue'),
                'backgroundColor' => 'rgba(59,130,246,0.5)'
            ]]
        ];

        return response()->json([
            'charts' => [
                'bookings_by_time'   => $bookingChart,
                'revenue_by_month'   => $revenueChart,
                'top_room_revenue'   => $topRoomRevenueChart,
            ],
        ]);
    }
}
