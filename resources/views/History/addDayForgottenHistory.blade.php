@extends('Layouts.html')
@extends('Layouts.nav.nav-bar')
@section('tittle-head')
    Add Day
@endsection

<?php
use Carbon\Carbon;
?>


@section('principal-container')
    <section id="home-history">


        {{-- TITULO SECCION --}}
        <article id="section-tittle-history">
            <div class="back" onclick="back()"><i class='bx bx-chevron-left'></i></div>
            <div class="tittle"><span>Agregar compra</span></div>
            <div class="invisible">
                <p>p</p>
            </div>
        </article>



        {{-- CONTENDERO --}}
        <section id="list-history">

            <p>Si olvidaste anotar un gasto aqui puedes seleccionar el dia y anotarlo facilmente</p>

            {{-- <form id="forgotten-day" action="{{ route('history.addforgottenDay') }}" method="POST"> --}}
            <form id="forgotten-day"method="POST">
                {{-- token para seguridad --}}
                @csrf
                {{-- token para seguridad --}}
                <input type="text" name="name" placeholder="Nombre" required>
                <input type="text" inputmode="numeric" name="price" class="price" placeholder="Precio" required>
                <input type="hidden" name="category" id="category">
                <input type="date" name="date" placeholder="Selecciona una fecha ->" required>
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                <button>Agregar</button>

                {{-- <button>Add</button> --}}
            </form>
        </section>

        <div id="categoryModal">
            <div>
                <h2>Selecciona una Categoría</h2>
                <ul class="categories">
                    <li data-category=1>
                        <div class="icon">
                            <i class="fa-solid fa-burger"></i>
                        </div>
                    </li>
                    <li data-category=2>
                        <div class="icon">
                            <i class="fa-solid fa-spray-can-sparkles"></i>
                        </div>
                    </li>
                    <li data-category=3>
                        <div class="icon">
                            <i class="fa-solid fa-gift"></i>
                        </div>
                    </li>
                    <li data-category=4>
                        <div class="icon">                            
                            <i class="fa-brands fa-bitcoin"></i>
                        </div>
                    </li>
                    <li data-category=5>
                        <div class="icon">
                            <i class="fa-solid fa-toilet-paper"></i>
                        </div>
                    </li>
                    <li data-category=6>
                        <div class="icon">
                            <i class="fa-solid fa-bus"></i>
                        </div>
                    </li>
                    <li data-category=7>
                        <div class="icon">
                            <i class="fa-solid fa-receipt"></i>
                        </div>
                    </li>
                    <li data-category=8>
                        <div class="icon">
                            <i class="fa-solid fa-paw"></i>
                        </div>
                    </li>
                    <li data-category=9>
                        <div class="icon">
                            <i class="fa-solid fa-bag-shopping"></i>
                        </div>
                    </li>
                    <li data-category=10>
                        <div class="icon">
                            <i class="fa-solid fa-ellipsis"></i>
                        </div>
                    </li>
                </ul>
                {{-- <button id="closeModal">Cerrar</button> --}}
            </div>
        </div>





    </section>
@endsection

@push('scripts')
    <script src="{{ asset('js/formatCOP.js') }}"></script>

    {{-- Ajax para insertar --}}
    <script>
        $(document).ready(function() {
            $('#forgotten-day').on('submit', function(e) {
                e.preventDefault(); // Evita el envío tradicional del formulario
                $('#categoryModal').css('display', 'flex'); // Muestra el modal
            });

            $('#categoryModal').on('click', 'li', function() {
                var category = $(this).data('category');
                $('#category').val(category); // Setea la categoría seleccionada en el campo oculto
                $('#categoryModal').hide(); // Oculta el modal

                // Envía el formulario automáticamente
                $.ajax({
                    url: '{{ route('history.addforgottenDay') }}',
                    method: 'POST',
                    data: $('#forgotten-day').serialize(), // Serializa los datos del formulario
                    success: function(response) {
                        $('#message').html('<span class="message-catched">' + response.message +
                            '</span>');
                        $('#forgotten-day')[0].reset(); // Resetea el formulario
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
    </script>
@endpush
