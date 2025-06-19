<script>
    $(document).ready(function () {
        select2LoadData($('#hotel_service_id').data('url'), '#hotel_service_id');
    });
    document.querySelector('input[name="quantity"]').addEventListener('input', function (e) {
        this.value = this.value.replace(/[^\d]/g, '');
    });
</script>