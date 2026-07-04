$(document).ready(function () {
    
    $('#course_id').on('change', function () {
        let selected = $(this).find(':selected');
        let fee = selected.data('fee');
        $('#final_fee').val(fee);
    });
    
});