$(document).ready(function () {
    
    $('#enrollment_id').on('change', function () {

        let selected = $(this).find(':selected');

        let name = selected.data('name');
        let course = selected.data('course');
        let fee = selected.data('fee');

        $('#student_name').text(name);
        $('#course_name').text(course);
        $('#amount_preview').text('RM ' + fee);
    });
    
});