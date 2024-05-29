// document.addEventListener("DOMContentLoaded", function() {
//     var priceInput = document.getElementById('price');

//     priceInput.addEventListener('input', function(event) {
//         // Eliminar cualquier caracter que no sea un número
//         var formattedValue = this.value.replace(/[^\d]/g, '');

//         // Agregar comas como separadores de miles
//         formattedValue = formattedValue.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

//         // Agregar la moneda COP al principio del valor
//         formattedValue = formattedValue;

//         // Actualizar el valor del input con el formato deseado
//         this.value = formattedValue;
//     });
// });

var priceInputs = document.querySelectorAll('.price');

priceInputs.forEach(function (input) {
    input.addEventListener('input', function (event) {
        // Eliminar cualquier caracter que no sea un número
        var formattedValue = this.value.replace(/[^\d]/g, '');

        // Agregar comas como separadores de miles
        formattedValue = formattedValue.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        // Agregar la moneda COP al principio del valor
        formattedValue = formattedValue;

        // Actualizar el valor del input con el formato deseado
        this.value = formattedValue;
    });
});
