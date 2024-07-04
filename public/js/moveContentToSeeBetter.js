$(document).ready(function () {
    // Agrega un controlador de eventos focus a todos los campos de entrada
    $('input, textarea').focus(function () {
        // Verifica si el formulario actual tiene un cierto id
        if ($(this).closest('form').attr('id') !== 'incomes-form') {
            // Si es un dispositivo móvil, desplaza la página hacia arriba
            if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator
                .userAgent)) {
                $('html, body').animate({
                    scrollTop: $(this).offset().top -
                        20 // Ajusta la posición final del desplazamiento
                }, 200); // Duración de la animación en milisegundos
            }
        }
    });
});