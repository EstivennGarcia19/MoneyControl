$(document).ready(function() {
    // Obtén la URL actual
    var currentUrl = window.location.href;

    // Itera sobre cada enlace dentro de la barra de navegación
    $('#nav-buttons a').each(function() {
        var linkUrl = $(this).attr('href');

        // Comprueba si la URL actual coincide con la URL del enlace
        if (currentUrl === linkUrl) {
            // Agrega la clase 'active' a la clase 'icon-button' del enlace activo
            $(this).find('.icon-button').addClass('active');
        }
    });
});