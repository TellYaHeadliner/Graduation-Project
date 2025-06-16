<script>
    $(document).ready(function () {
        select2LoadData($('#user_id').data('url'), '#user_id');
        select2LoadData($('#hotel_id').data('url'), '#hotel_id');
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const discountTypeSelect = document.getElementById('discount_type');
        const maxDiscountGroup = document.getElementById('max_discount_value_group');
        const discountValuePrice = document.getElementById('discount_value_price');
        const discountValuePercent = document.getElementById('discount_value_percent');

        function toggleMaxDiscount() {
            if (discountTypeSelect.value === "1") {
                maxDiscountGroup.style.display = 'block';
                discountValuePrice.style.display = 'none';
                discountValuePercent.style.display = 'block';
            } else {
                maxDiscountGroup.style.display = 'none';
                discountValuePrice.style.display = 'block';
                discountValuePercent.style.display = 'none';

            }
        };

        toggleMaxDiscount();
        discountTypeSelect.addEventListener('change', toggleMaxDiscount);
    });

</script>