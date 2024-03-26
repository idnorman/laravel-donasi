$('input, textarea').on('keydown change', function() {
    if ($(this).hasClass('is-invalid')) {
        $(this).removeClass('is-invalid');
        $(this).next('small').hide();
    }
});

$(document).ready(function() {
    $('.note-editable').on('keydown change', function() {
        if ($('.content-textarea').hasClass('is-invalid')) {
            $('.content-textarea').removeClass('is-invalid');
            $('.content-textarea-invalid-feedback').hide();
        }
    });
});

