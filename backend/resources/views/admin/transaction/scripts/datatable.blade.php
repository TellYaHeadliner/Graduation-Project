<script>
    const typeOptions = @json(\App\Enums\Transaction\TransactionType::asSelectArray());
    const statusOptions = @json(\App\Enums\Transaction\TransactionStatus::asSelectArray());
    function searchColumsDataTable(datatable) {
        datatable.api().columns([0, 1, 2, 3, 4, 5, 6, 7]).every(function () {
            var column = this;
            var input = document.createElement("input");

            input.setAttribute('placeholder', 'Nhập từ khóa');
            input.setAttribute('class', 'form-control');

            if (column.selector.cols == 7) {
                input.setAttribute('type', 'date');
            }
            if (column.selector.cols == 6) {
                input = document.createElement("select");
                generateSelectOptions(input, statusOptions);
            }
            if (column.selector.cols == 3) {
                input = document.createElement("select");
                generateSelectOptions(input, typeOptions);
            }

            $(input).appendTo($(column.footer()).empty())
                .on('change', function () {
                    column.search($(this).val(), false, false, true).draw();
                });
        });
    }
    $(document).ready(function () {
        columns = window.LaravelDataTables["transactionAdminTable"].columns();
        toggleColumnsDatatable(columns);
    });
</script>