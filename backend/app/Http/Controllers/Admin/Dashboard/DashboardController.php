<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Enums\Booking\BookingStatus;
use App\Enums\Transaction\TransactionType;     
use App\Enums\Transaction\TransactionStatus; 

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
        return view($this->view['index']);
    }

    public function data(Request $request)
    {
        
        $from    = Carbon::parse($request->input('from', now()->subMonths(12)->startOfMonth()));
        $to      = Carbon::parse($request->input('to',   now()->endOfMonth()));
        $groupBy = $request->input('group_by', 'month');   // day | month | year

        $format = match ($groupBy) {
            'day'  => '%Y-%m-%d',
            'year' => '%Y',
            default => '%Y-%m',
        };

        
        $summary = [
            'total_users'        => DB::table('users')->count(),
            'total_hotels'       => DB::table('hotels')->count(),
            'hotels_active'      => DB::table('hotels')->where('status', 'active')->count(),
            'hotels_pending'     => DB::table('hotels')->where('status', 'pending')->count(),
            'hotels_blocked'     => DB::table('hotels')->where('status', 'blocked')->count(),
            'total_bookings'     => DB::table('bookings')->count(),
            'total_transactions' => DB::table('transactions')->count(),
        ];

       
        $usersRaw = DB::table('users')
            ->selectRaw("DATE_FORMAT(created_at,'{$format}') AS time, COUNT(*) AS total")
            ->whereBetween('created_at', [$from, $to])
            ->groupBy('time')
            ->orderBy('time')
            ->get();

        $usersGrowth = [
            'labels'   => $usersRaw->pluck('time'),
            'datasets' => [[
                'label'           => 'Người dùng mới',
                'data'            => $usersRaw->pluck('total'),
                'borderColor'     => '#10b981',
                'backgroundColor' => 'rgba(16,185,129,0.2)',
                'tension'         => .3
            ]]
        ];

       
        $hotelStatus = [
            'labels' => ['Hoạt động','Chờ duyệt','Bị khóa'],
            'datasets' => [[
                'label'           => 'Khách sạn',
                'data'            => [$summary['hotels_active'],$summary['hotels_pending'],$summary['hotels_blocked']],
                'backgroundColor' => ['#3b82f6','#f59e0b','#ef4444']
            ]]
        ];

       
        $bookingRaw = DB::table('bookings')
            ->selectRaw("
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
            ])
            ->whereBetween('created_at', [$from, $to])
            ->groupBy('time')
            ->orderBy('time')
            ->get();

        $bookingsByTime = [
            'labels'   => $bookingRaw->pluck('time'),
            'datasets' => [
                [
                    'label'           => 'Tổng đặt phòng',
                    'data'            => $bookingRaw->pluck('total'),
                    'backgroundColor' => 'rgba(59,130,246,0.5)',
                ],
                [
                    'label'           => 'Thành công',
                    'data'            => $bookingRaw->pluck('success'),
                    'backgroundColor' => 'rgba(16,185,129,0.5)',
                ],
                [
                    'label'           => 'Huỷ',
                    'data'            => $bookingRaw->pluck('cancel'),
                    'backgroundColor' => 'rgba(239,68,68,0.5)',
                ],
            ]
        ];

       
        $revenueRaw = DB::table('transactions')
            ->selectRaw("
                DATE_FORMAT(created_at,'%Y-%m') AS month,
                SUM(amount)           AS gross,
                SUM(commission_amount) AS commission
            ")
            ->where('transaction_type', TransactionType::Release->value)  // 1 = Release
            ->where('payment_status', TransactionStatus::Success->value)
            ->whereBetween('created_at', [$from, $to])
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $revenueByMonth = [
            'labels' => $revenueRaw->pluck('month'),
            'datasets' => [
                [
                    'label'           => 'Doanh thu gộp',
                    'data'            => $revenueRaw->pluck('gross'),
                    'borderColor'     => '#3b82f6',
                    'backgroundColor' => 'rgba(59,130,246,0.2)',
                    'tension'         => .3
                ],
                [
                    'label'           => 'Hoa hồng',
                    'data'            => $revenueRaw->pluck('commission'),
                    'borderColor'     => '#ef4444',
                    'backgroundColor' => 'rgba(239,68,68,0.2)',
                    'tension'         => .3
                ],
            ]
        ];

      
        $transBreak = DB::table('transactions')
            ->selectRaw('transaction_type, COUNT(*) AS count, SUM(amount) AS total')
            ->groupBy('transaction_type')
            ->get();

        $transChart = [
            'labels'   => $transBreak->pluck('transaction_type')->map(fn($t) => match ($t) {
                TransactionType::Holding->value  => 'Giữ tiền',
                TransactionType::Release->value  => 'Chi cho KS',
                TransactionType::Refund->value   => 'Hoàn tiền',
                default                          => 'Khác',
            }),
            'datasets' => [[
                'label'           => 'Tổng tiền',
                'data'            => $transBreak->pluck('total'),
                'backgroundColor' => ['#f59e0b','#10b981','#ef4444']
            ]]
        ];

        
        $finance = DB::table('transactions')->selectRaw("
            SUM(CASE WHEN transaction_type = ? THEN amount END) AS hold,
            SUM(CASE WHEN transaction_type = ? THEN amount END) AS payout,
            SUM(CASE WHEN transaction_type = ? THEN amount END) AS refund
        ",
        [
            TransactionType::Holding->value,
            TransactionType::Release->value,
            TransactionType::Refund->value,
        ])->first();

        
        $topHotelRevenue = DB::table('bookings')
            ->join('hotels','hotels.id','=','bookings.hotel_id')
            ->selectRaw('hotels.name, SUM(total_amount) AS revenue')
            ->where('bookings.status', BookingStatus::CheckedOut->value)
            ->groupBy('hotels.id','hotels.name')
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

        
        $topHotelBookings = DB::table('bookings')
            ->join('hotels','hotels.id','=','bookings.hotel_id')
            ->selectRaw('hotels.name, COUNT(bookings.id) AS total')
            ->groupBy('hotels.id','hotels.name')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $topHotelBookingsChart = [
            'labels'   => $topHotelBookings->pluck('name'),
            'datasets' => [[
                'label'           => 'Số booking',
                'data'            => $topHotelBookings->pluck('total'),
                'backgroundColor' => 'rgba(16,185,129,0.5)'
            ]]
        ];

       
        $newHotelRaw = DB::table('hotels')
            ->selectRaw("DATE_FORMAT(created_at,'%Y-%m') AS month, COUNT(*) AS total")
            ->whereBetween('created_at', [$from, $to])
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $newHotelsChart = [
            'labels'   => $newHotelRaw->pluck('month'),
            'datasets' => [[
                'label'           => 'Khách sạn mới',
                'data'            => $newHotelRaw->pluck('total'),
                'borderColor'     => '#f59e0b',
                'backgroundColor' => 'rgba(245,158,11,0.2)',
                'tension'         => .3
            ]]
        ];

        
        $topUsers = DB::table('bookings')
            ->join('users','users.id','=','bookings.customer_id')
            ->selectRaw('users.fullname, COUNT(bookings.id) AS total')
            ->where('bookings.status', BookingStatus::CheckedOut->value)
            ->groupBy('users.id','users.fullname')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $topUsersChart = [
            'labels' => $topUsers->pluck('name'),
            'datasets' => [[
                'label'           => 'Số booking',
                'data'            => $topUsers->pluck('total'),
                'backgroundColor' => 'rgba(239,68,68,0.5)'
            ]]
        ];

        return response()->json([
            'summary' => $summary,
            'charts'  => [
                'users_growth'        => $usersGrowth,
                'hotels_status'       => $hotelStatus,
                'bookings_by_time'    => $bookingsByTime,
                'revenue_by_month'    => $revenueByMonth,
                'transactions'        => $transChart,
                'finance_totals'      => $finance,
                'top_hotels_revenue'  => $topHotelRevenueChart,
                'top_hotels_bookings' => $topHotelBookingsChart,
                'new_hotels'          => $newHotelsChart,
                'top_users_bookings'  => $topUsersChart,
            ],
        ]);
    }
}
