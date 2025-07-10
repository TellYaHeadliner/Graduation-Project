<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Enums\Booking\BookingStatus;
use App\Enums\Hotel\HotelStatus;
use App\Enums\Transaction\TransactionType;
use App\Enums\Transaction\TransactionStatus;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getView()
    {
        return ['index' => 'admin.dashboard.index'];
    }

    public function index()
    {
        $summary = [
            'total_users'        => DB::table('users')->count(),
            'total_hotels'       => DB::table('hotels')->count(),
            'hotels_active'      => DB::table('hotels')->where('status', HotelStatus::Active->value)->count(),
            'hotels_pending'     => DB::table('hotels')->where('status', HotelStatus::Pending->value)->count(),
            'hotels_blocked'     => DB::table('hotels')->where('status', HotelStatus::Blocked->value)->count(),
            'total_bookings'     => DB::table('bookings')->count(),
            'total_transactions' => DB::table('transactions')->count(),
            'total_commission'   => Transaction::where('transaction_type', TransactionType::Release)->where('payment_status', TransactionStatus::Success->value)->sum('commission_amount'),
            'total_holding'      => Transaction::where('transaction_type', TransactionType::Holding)
                ->whereDoesntHave('booking.transactions', function ($q) {
                    $q->whereIn('transaction_type', [
                        TransactionType::Refund->value,
                        TransactionType::Release->value,
                    ]);
                })
                ->sum('amount'),
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

        $nguoiDungMoi = DB::table('users')
            ->selectRaw("DATE_FORMAT(created_at,'{$format}') AS time, COUNT(*) AS total")
            ->whereBetween('created_at', [$from, $to])
            ->groupBy('time')
            ->orderBy('time')
            ->get();

        $chartNguoiDungMoi = [
            'labels'   => $nguoiDungMoi->pluck('time'),
            'datasets' => [[
                'label'           => 'Người dùng mới',
                'data'            => $nguoiDungMoi->pluck('total'),
                'borderColor'     => '#10b981',
                'backgroundColor' => 'rgba(16,185,129,0.2)',
                'tension'         => .3
            ]]
        ];

        $bieuDoBooking = DB::table('bookings')
            ->selectRaw(
                "
            DATE_FORMAT(created_at,'{$format}') AS time,
            COUNT(*) AS total,
            SUM(CASE WHEN status IN (?, ?, ?) THEN 1 END) AS success,
            SUM(CASE WHEN status = ?            THEN 1 END) AS cancel
        ",
                [
                    BookingStatus::Confirmed->value,
                    BookingStatus::CheckedIn->value,
                    BookingStatus::CheckedOut->value,
                    BookingStatus::Cancelled->value
                ]
            )
            ->whereBetween('created_at', [$from, $to])
            ->groupBy('time')
            ->orderBy('time')
            ->get();

        $bookingsByTime = [
            'labels'   => $bieuDoBooking->pluck('time'),
            'datasets' => [
                [
                    'label'           => 'Tổng đặt phòng',
                    'data'            => $bieuDoBooking->pluck('total'),
                    'backgroundColor' => 'rgba(59,130,246,0.5)',
                ],
                [
                    'label'           => 'Thành công',
                    'data'            => $bieuDoBooking->pluck('success'),
                    'backgroundColor' => 'rgba(16,185,129,0.5)',
                ],
                [
                    'label'           => 'Huỷ',
                    'data'            => $bieuDoBooking->pluck('cancel'),
                    'backgroundColor' => 'rgba(239,68,68,0.5)',
                ],
            ]
        ];

        $doanhThu = DB::table('bookings')
            ->leftJoin('transactions', function ($join) {
                $join->on('transactions.booking_id', '=', 'bookings.id')
                    ->where('transactions.transaction_type', TransactionType::Release->value)
                    ->where('transactions.payment_status', TransactionStatus::Success->value);
            })
            ->selectRaw("
        DATE_FORMAT(bookings.created_at, '{$format}') AS time,
        SUM(bookings.total_amount) AS gross,
        SUM(transactions.commission_amount) AS commission
    ")
            ->where('bookings.status', BookingStatus::CheckedOut->value)
            ->whereBetween('bookings.created_at', [$from, $to])
            ->groupBy('time')
            ->orderBy('time')
            ->get();

        $revenueByMonth = [
            'labels' => $doanhThu->pluck('time'),
            'datasets' => [
                [
                    'label'           => 'Doanh thu gộp',
                    'data'            => $doanhThu->pluck('gross'),
                    'borderColor'     => '#3b82f6',
                    'backgroundColor' => 'rgba(59,130,246,0.2)',
                    'tension'         => .3
                ],
                [
                    'label'           => 'Hoa hồng',
                    'data'            => $doanhThu->pluck('commission'),
                    'borderColor'     => '#ef4444',
                    'backgroundColor' => 'rgba(239,68,68,0.2)',
                    'tension'         => .3
                ],
            ]
        ];

        $topHotelRevenue = DB::table('transactions')
            ->join('bookings', 'bookings.id', '=', 'transactions.booking_id')
            ->join('hotels', 'hotels.id', '=', 'bookings.hotel_id')
            ->selectRaw('hotels.name, SUM(transactions.amount) AS revenue')
            ->where('transactions.transaction_type', TransactionType::Release->value)
            ->where('transactions.payment_status', TransactionStatus::Success->value)
            ->groupBy('hotels.id', 'hotels.name')
            ->orderByDesc('revenue')
            ->limit(5)
            ->get();


        $topHotelRevenueChart = [
            'labels'   => $topHotelRevenue->pluck('name'),
            'datasets' => [[
                'label'           => 'Doanh thu',
                'data'            => $topHotelRevenue->pluck('revenue'),
                'backgroundColor' => 'rgba(59,130,246,0.5)'
            ]]
        ];

        return response()->json([
            'charts' => [
                'users_growth'        => $chartNguoiDungMoi,
                'bookings_by_time'    => $bookingsByTime,
                'revenue_by_month'    => $revenueByMonth,
                'top_hotels_revenue'  => $topHotelRevenueChart,
            ],
        ]);
    }
}
