<script>
    const statusOptions = @json(\App\Enums\Notification\NotificationStatus::asSelectArray());
    function searchColumsDataTable(datatable) {
        datatable.api().columns([0, 1, 2]).every(function () {
            var column = this;
            var input = document.createElement("input");

            input.setAttribute('placeholder', 'Nhập từ khóa');
            input.setAttribute('class', 'form-control');

            if (column.selector.cols == 2) {
                input.setAttribute('type', 'date')
            }

            $(input).appendTo($(column.footer()).empty())
                .on('change', function () {
                    column.search($(this).val(), false, false, true).draw();
                });
        });
    }
    $(document).ready(function () {
        columns = window.LaravelDataTables["notificationTable"].columns();
        toggleColumnsDatatable(columns);
    });
</script>