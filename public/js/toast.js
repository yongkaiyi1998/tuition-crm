function showToast(message, type = 'success') {

    let toastEl = $('#appToast');

    toastEl.removeClass('text-bg-success text-bg-danger text-bg-warning');

    if (type === 'success') toastEl.addClass('text-bg-success');
    if (type === 'error') toastEl.addClass('text-bg-danger');
    if (type === 'warning') toastEl.addClass('text-bg-warning');

    $('#appToastMessage').text(message);

    let toast = new bootstrap.Toast(document.getElementById('appToast'));

    toast.show();
}