$(document).ready(function() {
    $('#expense-form').on('submit', function(e) {
        e.preventDefault(); // Evita el envío tradicional del formulario
        $('#categoryModal').css('display', 'flex'); // Muestra el modal
    });

    $('#categoryModal').on('click', 'li', function() {
        var category = $(this).data('category');
        $('#category').val(category); // Setea la categoría seleccionada en el campo oculto
        $('#categoryModal').hide(); // Oculta el modal

        // Envía el formulario automáticamente
        $.ajax({
            url: '{{ route("expenses.store") }}',
            method: 'POST',
            data: $('#expense-form').serialize(), // Serializa los datos del formulario
            success: function(response) {
                $('#message').html('<span class="message-catched">' + response.message +
                    '</span>');
                $('#expense-form')[0].reset(); // Resetea el formulario
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors;
                var errorMessage = '';
                $.each(errors, function(key, value) {
                    errorMessage += '<span>' + value + '</span><br>';
                });
                $('#message').html(errorMessage);
            }
        });
    });

    $('#closeModal').on('click', function() {
        $('#categoryModal').hide(); // Cierra el modal
    });
});