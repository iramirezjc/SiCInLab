$(document).ready(function () {

    $('#esConsumible').on('change', function () {
        if ($(this).is(':checked')) {
            $('#devol').hide();
            $('#devolucion').prop('disabled', true);
        } else {
            $('#devol').show();
            $('#devolucion').prop('disabled', false);
        }
    });
});