<script>
    axios.defaults.headers.common['X-CSRF-TOKEN'] =
        document.querySelector('meta[name="csrf-token"]').content;

    let charts = {};

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

        axios.get('http://127.0.0.1:8000/admin/dashboard/data', {
            params: { from, to, group_by: group }
        }).then(res => {
            const { charts: data } = res.data;

            console.log(data.revenue_by_month.datasets[0]); // Doanh thu gộp

            makeChart('usersChart', 'line', data.users_growth);
            makeChart('bookingsChart', 'bar', data.bookings_by_time, {
                scales: {
                    x: { stacked: true },
                    y: { stacked: true }
                }
            });
            makeChart('revenueChart', 'line', data.revenue_by_month);
            makeChart('topHotelRevenueChart', 'bar', data.top_hotels_revenue);

        }).catch(err => console.error("Lỗi khi tải dashboard:", err));
    }

    document.addEventListener('DOMContentLoaded', loadDashboard);
</script>