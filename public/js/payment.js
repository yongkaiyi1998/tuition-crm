$(document).ready(function () {
    
    $('#invoice_id').on('change', function () {

        let selected = $(this).find(':selected');

        let student = selected.data('student');
        let course = selected.data('course');
        let balance = selected.data('balance');

        $('#student_name').text(student);
        $('#course_name').text(course);
        $('#balance').text('RM ' + balance);
    });
    
});