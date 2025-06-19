<script>
    const statusOptions = @json(\App\Enums\HotelService\HotelServiceStatus::asSelectArray());
    function searchColumsDataTable(datatable) {
        datatable.api().columns([0, 1, 2, 3, 4, 5]).every(function () {
            var column = this;
            var input = document.createElement("input");

            input.setAttribute('placeholder', 'Nhập từ khóa');
            input.setAttribute('class', 'form-control');

            if (column.selector.cols == 5) {
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
        columns = window.LaravelDataTables["hotelServiceTable"].columns();
        toggleColumnsDatatable(columns);
    });
</script>