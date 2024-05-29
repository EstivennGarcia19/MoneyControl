$(document).ready(function() {
    // Obtener la URL actual
    var currentUrl = window.location.pathname;

    // Recorrer cada enlace en la barra de navegación
    $("#nav-buttons .link-nav a").each(function() {
        var linkUrl = $(this).attr("href");

        // Comprobar si la URL actual coincide con la URL del enlace
        if (currentUrl === linkUrl) {
            // Eliminar la clase "active" de todos los elementos
            $("#nav-buttons .link-nav").removeClass("active");
            
            // Agregar la clase "active" al elemento padre (el <li>) del enlace correspondiente
            $(this).closest("li").addClass("active");
        }
    });
});