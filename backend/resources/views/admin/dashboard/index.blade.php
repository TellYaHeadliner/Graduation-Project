@extends('layouts.master')

@push('libs-css')
@endpush

@section('content')
    <div class="page-body">
       
    </div>
@endsection

@push('libs-js')
<!-- button in datatable -->
<script src="{{ asset('/vendor/datatables/buttons.server-side.js') }}"></script>

@endpush

@push('custom-js')

@include('ckfinder::setup')

@endpush

{{-- @extends('layouts.master')

@push('libs-css')
    
@endpush

@section('content')
    <div class="page-body">
        <div class="container mx-auto py-6 space-y-8">
            <h1 class="text-3xl font-bold mb-4">Dashboard hệ thống Roomix</h1>

            <div id="summaryCards" class="grid grid-cols-2 md:grid-cols-4 gap-4">
                
            </div>

            <div class="flex items-center gap-2">
                <input type="date" id="fromDate" class="border rounded px-2 py-1"
                    value="{{ now()->subMonths(12)->startOfMonth()->toDateString() }}">
                <input type="date" id="toDate" class="border rounded px-2 py-1" value="{{ now()->toDateString() }}">
                <select id="groupBy" class="border rounded px-2 py-1">
                    <option value="month" selected>Theo tháng</option>
                    <option value="day">Theo ngày</option>
                    <option value="year">Theo năm</option>
                </select>
                <button onclick="loadDashboard()" class="bg-blue-500 text-black px-4 py-1 rounded">
                    Tải lại
                </button>
            </div>

            <div class="flex flex-col gap-8">
                <div class="h-64"><canvas id="usersChart" class="w-full h-full"></canvas></div>
                <div class="h-64"><canvas id="hotelsStatusChart" class="w-full h-full"></canvas></div>
                <div class="h-64"><canvas id="bookingsChart" class="w-full h-full"></canvas></div>
                <div class="h-64"><canvas id="revenueChart" class="w-full h-full"></canvas></div>
                <div class="h-64"><canvas id="transactionsChart" class="w-full h-full"></canvas></div>
                <div class="h-64"><canvas id="topHotelRevenueChart" class="w-full h-full"></canvas></div>
                <div class="h-64"><canvas id="topHotelBookingsChart" class="w-full h-full"></canvas></div>
                <div class="h-64"><canvas id="newHotelsChart" class="w-full h-full"></canvas></div>
                <div class="h-64"><canvas id="topUsersChart" class="w-full h-full"></canvas></div>
            </div>

        </div>
    </div>
@endsection

@push('libs-js')
    <!-- Chart.js & Axios -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endpush

@push('custom-js')
    <script>
        
        axios.defaults.headers.common['X-CSRF-TOKEN'] =
            document.querySelector('meta[name="csrf-token"]').content;

        let charts = {}; 

        function renderSummary(summary) {
            const container = document.getElementById('summaryCards');
            container.innerHTML = `
                            <div class="p-4 bg-white shadow rounded">Người dùng<br>
                                <span class="text-2xl font-bold">${summary.total_users}</span>
                            </div>
                            <div class="p-4 bg-white shadow rounded">Khách sạn<br>
                                <span class="text-2xl font-bold">${summary.total_hotels}</span>
                            </div>
                            <div class="p-4 bg-white shadow rounded">Booking<br>
                                <span class="text-2xl font-bold">${summary.total_bookings}</span>
                            </div>
                            <div class="p-4 bg-white shadow rounded">Giao dịch<br>
                                <span class="text-2xl font-bold">${summary.total_transactions}</span>
                            </div>
                        `;
        }

        function makeChart(id, type, data, options = {}) {
            const ctx = document.getElementById(id).getContext('2d');
            if (charts[id]) charts[id].destroy(); 
            charts[id] = new Chart(ctx, {
                type,
                data,
                options: {
                    responsive: true,
                    maintainAspectRatio: false, 
                    ...options
                }
            });
        }

        function loadDashboard() {
            const from = document.getElementById('fromDate').value;
            const to = document.getElementById('toDate').value;
            const group = document.getElementById('groupBy').value;

            axios.get('{{ route('admin.dashboard.data') }}', {
                params: { from, to, group_by: group }
            }).then(res => {
                const { summary, charts: chartData } = res.data;

                renderSummary(summary);

                makeChart('usersChart', 'line', chartData.users_growth);
                makeChart('hotelsStatusChart', 'doughnut', chartData.hotels_status);
                makeChart('bookingsChart', 'bar', chartData.bookings_by_time, {
                    scales: {
                        x: { stacked: true },
                        y: { stacked: true }
                    }
                });
                makeChart('revenueChart', 'line', chartData.revenue_by_month);
                makeChart('transactionsChart', 'doughnut', chartData.transactions);
                makeChart('topHotelRevenueChart', 'bar', chartData.top_hotels_revenue);
                makeChart('topHotelBookingsChart', 'bar', chartData.top_hotels_bookings);
                makeChart('newHotelsChart', 'line', chartData.new_hotels);
                makeChart('topUsersChart', 'bar', chartData.top_users_bookings);

            }).catch(err => console.error("Lỗi khi tải dashboard:", err));
        }

        document.addEventListener('DOMContentLoaded', loadDashboard);
    </script>
@endpush

@push('custom-js')
    @include('ckfinder::setup')
@endpush --}}
