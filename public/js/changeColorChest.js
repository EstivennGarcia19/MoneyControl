$(document).ready(function() {
    var selectedColor = null;

    $('.color-circle').on('click', function() {
        $('.color-circle').removeClass('selected');
        $(this).addClass('selected');
        selectedColor = $(this).data('color');
    });

    $('#applyColorBtn').on('click', function() {
        if (selectedColor) {
            window.location.href = `/apply-color/${selectedColor}`;
        } else {
            alert('Por favor, selecciona un color.');
        }
    });
});

function changeColor(color) {        

    const form = document.getElementById("form-change-cc")
    form.action = form.action.replace("replace", color);
}