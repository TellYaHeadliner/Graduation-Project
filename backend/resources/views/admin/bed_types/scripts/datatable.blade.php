<script>
    function searchColumsDataTable(datatable) {
        datatable.api().columns([0]).every(function () {
            var column = this;
            var input = document.createElement("input");
    
            input.setAttribute('placeholder', 'Nhập từ khóa');
            input.setAttribute('class', 'form-control');
    
            $(input).appendTo($(column.footer()).empty())
            .on('change', function () {
                column.search($(this).val(), false, false, true).draw();
            });
        }); 
    }
    $(document).ready(function() {
        columns = window.LaravelDataTables["bedTypeTable"].columns();
        toggleColumnsDatatable(columns);
    });
</script>