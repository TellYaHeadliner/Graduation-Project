<script>
    document.addEventListener('DOMContentLoaded', function () {
        // ========== Cancel Policy Logic ==========
        const cancelSelect = document.getElementById('cancel_policy_select');
        const feeTypeGroup = document.getElementById('fee_type_group');
        const feeAmountGroup = document.getElementById('fee_amount_group');
        const feeTypeSelect = document.getElementById('fee_type_select');
        const feeAmountPrice = document.getElementById('fee_amount_price');
        const feeAmountPercent = document.getElementById('fee_amount_percent');

        function toggleFeeFields() {
            if (!cancelSelect) return;
            const selected = cancelSelect.value;
            const shouldShow = selected === 'free_before and fee_after';

            feeTypeGroup.style.display = shouldShow ? 'block' : 'none';
            feeAmountGroup.style.display = shouldShow ? 'block' : 'none';

            if (shouldShow) {
                toggleFeeAmountInput();
            }
        }

        function toggleFeeAmountInput() {
            if (!feeTypeSelect) return;
            const selectedFeeType = feeTypeSelect.value;

            feeAmountPrice.style.display = selectedFeeType === '1' ? 'none' : 'block';
            feeAmountPercent.style.display = selectedFeeType === '1' ? 'block' : 'none';
        }

        if (cancelSelect) cancelSelect.addEventListener('change', toggleFeeFields);
        if (feeTypeSelect) feeTypeSelect.addEventListener('change', toggleFeeAmountInput);
        toggleFeeFields(); // Gọi ngay khi load

        // ========== Discount Type Logic ==========
        const typeSelect = document.getElementById('discount_type_select');
        const priceGroup = document.getElementById('discount_price_group');
        const percentGroup = document.getElementById('discount_percent_group');

        function toggleDiscountInput() {
            if (!typeSelect) return;
            priceGroup.style.display = typeSelect.value === '1' ? 'none' : 'block';
            percentGroup.style.display = typeSelect.value === '1' ? 'block' : 'none';
        }

        if (typeSelect) typeSelect.addEventListener('change', toggleDiscountInput);
        toggleDiscountInput(); // Gọi ngay khi load

        // ========== Season Select2 ==========
        select2LoadData($('#season_id').data('url'), '#season_id');

        // ========== Input số nguyên ==========
        document.querySelector("input[name=\"attribute['guest']\"]")?.addEventListener('input', function (e) {
            this.value = this.value.replace(/[^\d]/g, '');
        });

        document.querySelector("input[name=\"attribute['children']\"]")?.addEventListener('input', function (e) {
            this.value = this.value.replace(/[^\d]/g, '');
        });
    });
</script>
