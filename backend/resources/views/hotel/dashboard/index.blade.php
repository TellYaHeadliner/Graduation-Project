@extends('layouts.master')

@push('libs-css')
    @include('hotel.dashboard.scripts.style')
@endpush

@section('content')
    <div class="page-body">
        <div id="root">
            <div class="container pt-2">
                <h2 class="dashboard-title">Tổng quan</h2>
                <div class="row align-items-stretch">
                    <div class="c-dashboardInfo col-md-6" style="width: 20%;">
                        <div class="wrap">
                            <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">Tổng số phòng
                            </h4>
                            <span class="hind-font caption-12 c-dashboardInfo__count">{{ $summary['total_rooms'] }}</span>
                        </div>
                    </div>
                    <div class="c-dashboardInfo col-md-6" style="width: 20%;">
                        <div class="wrap">
                            <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">Tổng booking
                            </h4>
                            <span
                                class="hind-font caption-12 c-dashboardInfo__count">{{ $summary['total_bookings'] }}</span>
                        </div>
                    </div>
                    <div class="c-dashboardInfo col-md-6" style="width: 20%;">
                        <div class="wrap">
                            <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">Thành công</h4>
                            <span
                                class="hind-font caption-12 c-dashboardInfo__count">{{ $summary['success_bookings'] }}</span>
                        </div>
                    </div>
                    <div class="c-dashboardInfo col-md-6" style="width: 20%;">
                        <div class="wrap">
                            <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">Doanh thu gộp
                            </h4>
                            <span
                                class="hind-font caption-12 c-dashboardInfo__count">{{ number_format($summary['gross_revenue']) }}
                                đ</span>
                        </div>
                    </div>
                    <div class="c-dashboardInfo col-md-6" style="width: 20%;">
                        <div class="wrap">
                            <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">Doanh thu thực
                            </h4>
                            <span
                                class="hind-font caption-12 c-dashboardInfo__count">{{ number_format($summary['net_revenue']) }}
                                đ</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex flex-wrap align-items-center gap-2 mb-4">
            <input type="date" id="fromDate" class="form-control form-control-sm w-auto"
                value="{{ now()->subMonths(12)->startOfMonth()->toDateString() }}">

            <input type="date" id="toDate" class="form-control form-control-sm w-auto"
                value="{{ now()->endOfMonth()->toDateString() }}">


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
                <h3 class="card-title">Thống kê đặt phòng theo thời gian</h3>
            </div>
            <div class="card-body" style="height: 350px;">
                <canvas id="bookingsChart" class="w-full h-full"></canvas>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Doanh thu booking theo thời gian</h3>
            </div>
            <div class="card-body" style="height: 350px;">
                <canvas id="revenueChart" class="chart-canvas" style="height: 100%; width: 100%;"></canvas>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Top 5 loại phòng doanh thu cao nhất</h3>
            </div>
            <div class="card-body" style="height: 350px;">
                <canvas id="topRoomRevenueChart" class="chart-canvas" style="height: 100%; width: 100%;"></canvas>
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
    @include('hotel.dashboard.scripts.scripts')
@endpush