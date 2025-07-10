@extends('layouts.master')

@push('libs-css')
    @include('admin.dashboard.scripts.style')
@endpush

@section('content')
    <div class="page-body">
        <div id="root">
            <div class="container pt-2">
                <h2 class="dashboard-title">Tổng quan</h2>
                <div class="row align-items-stretch">
                    <div class="c-dashboardInfo col-md-6" style="width: 20%;">
                        <div class="wrap">
                            <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">Tổng số người
                                dùng
                                <path fill="none" d="M0 0h24v24H0z"></path>
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z">
                                </path>
                                </svg>
                            </h4><span
                                class="hind-font caption-12 c-dashboardInfo__count">{{ $summary['total_users'] }}</span>
                        </div>
                    </div>
                    <div class="c-dashboardInfo col-md-6" style="width: 20%;">
                        <div class="wrap">
                            <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">Tổng giao dịch
                                <path fill="none" d="M0 0h24v24H0z"></path>
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z">
                                </path>
                                </svg>
                            </h4><span
                                class="hind-font caption-12 c-dashboardInfo__count">{{ $summary['total_transactions'] }}</span>
                        </div>
                    </div>
                    <div class="c-dashboardInfo col-md-6" style="width: 20%;">
                        <div class="wrap">
                            <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">Tổng số đơn đặt
                                phòng
                                <path fill="none" d="M0 0h24v24H0z"></path>
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z">
                                </path>
                                </svg>
                            </h4><span
                                class="hind-font caption-12 c-dashboardInfo__count">{{ $summary['total_bookings'] }}</span>
                        </div>
                    </div>
                    <div class="c-dashboardInfo col-md-6" style="width: 20%;">
                        <div class="wrap">
                            <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title"
                                style="font-size: 15px">Số tiền hệ thống đang giữ
                                <path fill="none" d="M0 0h24v24H0z"></path>
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z">
                                </path>
                                </svg>
                            </h4><span
                                class="hind-font caption-12 c-dashboardInfo__count">{{ format_money($summary['total_holding']) }}</span>
                        </div>
                    </div>
                    <div class="c-dashboardInfo col-md-6" style="width: 20%;">
                        <div class="wrap">
                            <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">Tổng doanh thu
                                <path fill="none" d="M0 0h24v24H0z"></path>
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z">
                                </path>
                                </svg>
                            </h4><span
                                class="hind-font caption-12 c-dashboardInfo__count">{{ format_money($summary['total_commission']) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="root">
            <div class="container pt-2">
                <h2 class="dashboard-title">Khách sạn</h2>
                <div class="row align-items-stretch">
                    <div class="c-dashboardInfo col-lg-3 col-md-6">
                        <div class="wrap">
                            <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">Tổng số khách
                                sạn
                                <path fill="none" d="M0 0h24v24H0z"></path>
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z">
                                </path>
                                </svg>
                            </h4><span
                                class="hind-font caption-12 c-dashboardInfo__count">{{ $summary['total_hotels'] }}</span>
                        </div>
                    </div>
                    <div class="c-dashboardInfo col-lg-3 col-md-6">
                        <div class="wrap">
                            <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">Số khách sạn
                                đang hoạt động
                                <path fill="none" d="M0 0h24v24H0z"></path>
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z">
                                </path>
                                </svg>
                            </h4><span
                                class="hind-font caption-12 c-dashboardInfo__count">{{ $summary['hotels_active'] }}</span>
                        </div>
                    </div>
                    <div class="c-dashboardInfo col-lg-3 col-md-6">
                        <div class="wrap">
                            <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">Số khách sạn
                                đang chờ duyệt
                                <path fill="none" d="M0 0h24v24H0z"></path>
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z">
                                </path>
                                </svg>
                            </h4><span
                                class="hind-font caption-12 c-dashboardInfo__count">{{ $summary['hotels_pending'] }}</span>
                        </div>
                    </div>
                    <div class="c-dashboardInfo col-lg-3 col-md-6">
                        <div class="wrap">
                            <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">Số khách sạn bị
                                khóa
                                <path fill="none" d="M0 0h24v24H0z"></path>
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z">
                                </path>
                                </svg>
                            </h4><span
                                class="hind-font caption-12 c-dashboardInfo__count">{{ $summary['hotels_blocked'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex flex-wrap align-items-center gap-2 mb-4">
            <input type="date" id="fromDate" class="form-control form-control-sm w-auto"
                value="{{ now()->subMonths(12)->startOfMonth()->toDateString() }}">

            <input type="date" id="toDate" class="form-control form-control-sm w-auto" value="{{ now()->toDateString() }}">

            <select id="groupBy" class="form-select form-select-sm w-auto">
                <option value="month" selected>Theo tháng</option>
                <option value="day">Theo ngày</option>
                <option value="year">Theo năm</option>
            </select>

            <button onclick="loadDashboard()" class="btn btn-sm btn-primary">
                <i class="ti ti-refresh me-1"></i> Tải lại
            </button>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tăng trưởng người dùng mới</h3>
            </div>
            <div class="card-body" style="height: 350px;">
                <canvas id="usersChart" class="chart-canvas" style="height: 100%; width: 100%;"></canvas>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Thống kê đặt phòng theo thời gian</h3>
            </div>
            <div class="card-body" style="height: 350px;">
                <canvas id="bookingsChart" class="w-full h-full"></canvas>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Doanh thu gộp & Hoa hồng hệ thống theo tháng</h3>
            </div>
            <div class="card-body" style="height: 350px;">
                <canvas id="revenueChart" class="chart-canvas" style="height: 100%; width: 100%;"></canvas>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Top khách sạn có doanh thu cao nhất</h3>
            </div>
            <div class="card-body" style="height: 350px;">
                <canvas id="topHotelRevenueChart" class="chart-canvas" style="height: 100%; width: 100%;"></canvas>
            </div>
        </div>
    </div>
@endsection

@push('libs-js')
    <script src="{{ asset('/vendor/datatables/buttons.server-side.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endpush

@push('custom-js')
    @include('ckfinder::setup')
    @include('admin.dashboard.scripts.scripts')
@endpush