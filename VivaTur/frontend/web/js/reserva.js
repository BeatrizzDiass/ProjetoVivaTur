$(document).ready(function() {
    var max = parseInt($('#quantidade').attr('max'));
    var min = parseInt($('#quantidade').attr('min'));

    $('#mais').click(function() {
        var atual = parseInt($('#quantidade').val());
        if (atual < max) {
            $('#quantidade').val(atual + 1);
        }
    });

    $('#menos').click(function() {
        var atual = parseInt($('#quantidade').val());
        if (atual > min) {
            $('#quantidade').val(atual - 1);
        }
    });
});