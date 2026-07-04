$(document).ready(function () {
    
    $('.btn-reset-password').on('click', function () {

        let userId = $(this).data('id');
        let userName = $(this).data('name');

        $('#userName').text(userName);
        $('#passwordForm').attr('action', '/users/' + userId + '/reset-password');
        $('#passwordForm')[0].reset();
        $('#errorBox').addClass('d-none').html('');
    });

    $('#passwordForm').on('submit', function (e) {
        e.preventDefault();

        let form = $(this);
        let url = form.attr('action');

        $('#errorBox').addClass('d-none').html('');

        $.ajax({
            url: url,
            method: 'POST',
            data: form.serialize(),
            beforeSend: function () {
                $('#submitBtn').prop('disabled', true).text('Processing...');
            },
            success: function (res) {
                $('#passwordModal').modal('hide');
                showToast(res.message, 'success');
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let html = '<ul class="mb-0">';
                    $.each(errors, function (key, value) {
                        html += '<li>' + $('<div>').text(value[0]).html() + '</li>';
                    });
                    html += '</ul>';
                    $('#errorBox').removeClass('d-none').html(html);
                }
            },
            complete: function () {
                $('#submitBtn').prop('disabled', false).text('Reset Password');
            }
        });
    });
});