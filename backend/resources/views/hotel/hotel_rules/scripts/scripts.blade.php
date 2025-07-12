<script>
    document.addEventListener("DOMContentLoaded", function () {

        // const childPolicySwitch = document.getElementById('child_policy');
        // const childAgeLimitBox = document.getElementById('child_age_limit_box');

        // if (childPolicySwitch) {
        //     childPolicySwitch.addEventListener('change', function () {
        //         if (this.checked) {
        //             childAgeLimitBox.style.display = 'block';
        //         } else {
        //             childAgeLimitBox.style.display = 'none';
        //         }
        //     });
        // }

        const extraBedSwitch = document.getElementById('extra_bed_fee_check');
        const extraBedBox = document.getElementById('extra_bed_fee_box');

        if (extraBedSwitch) {
            extraBedSwitch.addEventListener('change', function () {
                if (this.checked) {
                    extraBedBox.style.display = 'block';
                } else {
                    extraBedBox.style.display = 'none';
                }
            });
        }

    });

</script>