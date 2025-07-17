<script>
    const genderOptions = @json(\App\Enums\User\UserGender::asSelectArray());
    const roleOptions = @json(\App\Enums\User\UserRole::asSelectArray());
    const statusOptions = @json(\App\Enums\User\UserStatus::asSelectArray());
    function searchColumsDataTable(datatable) {
        datatable.api().columns([0, 1, 2, 3, 4, 6, 8]).every(function () {
            var column = this;
            var input = document.createElement("input");

            input.setAttribute('placeholder', 'Nhập từ khóa');
            input.setAttribute('class', 'form-control');

            if (column.selector.cols == 3) {
                input.setAttribute('type', 'date');
            }

            if (column.selector.cols == 8) {
                input = document.createElement("select");
                generateSelectOptions(input, statusOptions); 
            }
            if (column.selector.cols == 6) {
                input = document.createElement("select");
                generateSelectOptions(input, roleOptions);
            }
            if (column.selector.cols == 4) {
                input = document.createElement("select");
                generateSelectOptions(input, genderOptions);
            }

            $(input).appendTo($(column.footer()).empty())
                .on('change', function () {
                    column.search($(this).val(), false, false, true).draw();
                });
        });
    }
    $(document).ready(function () {
        columns = window.LaravelDataTables["userTable"].columns();
        toggleColumnsDatatable(columns);
    });
</script>