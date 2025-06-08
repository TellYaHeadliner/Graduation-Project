<script>
    const statusOptions = @json(\App\Enums\Season\SeasonStatus::asSelectArray());
    function searchColumsDataTable(datatable) {
        datatable.api().columns([0, 1, 2, 3]).every(function () {
            var column = this;
            var input = document.createElement("input");

            input.setAttribute('placeholder', 'Nhập từ khóa');
            input.setAttribute('class', 'form-control');

            if (column.selector.cols == 1) {
                input.setAttribute('type', 'date');
            }
            if (column.selector.cols == 2) {
                input.setAttribute('type', 'date');
            }
            if (column.selector.cols == 3) {
                input = document.createElement("select");
                generateSelectOptions(input, statusOptions);
            }

            $(input).appendTo($(column.footer()).empty())
                .on('change', function () {
                    column.search($(this).val(), false, false, true).draw();
                });
        });
    }
    $(document).ready(function () {
        columns = window.LaravelDataTables["seasonTable"].columns();
        toggleColumnsDatatable(columns);
    });
</script>