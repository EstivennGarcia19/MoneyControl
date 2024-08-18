@extends('Layouts.html')
@extends('Layouts.nav.nav-bar')
@extends('Layouts.nav.btn-expenses-nav')
@section('tittle-head')
    Home
@endsection


@section('principal-container')
    <div id="home">
        <div class="header">
            {{-- header principal nombre y  foto del usuario --}}
            <div class="user-information">

                <div class="cont-info-user">
                    <div class="photo-user">
                        <a href="{{ route('profile.show', ['id' => Auth::user()->id]) }}">
                            <img src="https://i.pinimg.com/originals/ef/e0/7d/efe07d9af104f338df556f48ba20ad62.png"
                                alt="Foto de usuario">
                        </a>
                    </div>
                    <div class="name-user">
                        <span><strong>Bienvenido!</strong></span><br>
                        <span class="user-name">{{ Auth::user()->name }}</span>
                    </div>
                </div>
                <div class="settings">
                    <a href="{{ route('login.logout') }}">
                        <i class='bx bx-log-in-circle'></i>
                    </a>
                </div>
            </div>

            {{-- tergeta del total de la plata ome --}}
            <div class="all-my-money">
                <article class="aBalance">
                    <span>Dinero disponible</span>
                    <h2>${{ $currentMoney }} COP</h2>
                </article>

                <button onclick="closeCard()" class="close-card">X</button>

                <form id="incomes-form" class="incomes-form" action="{{ route('incomes.store') }}" method="POST">
                    {{-- token para seguridad --}}
                    @csrf
                    <input type="text" inputmode="numeric" name="amount" class="price" placeholder="Cuanto hoy?"
                        required>
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <button class="btn-sent-income">Agregar monto</button>

                </form>
                <a href="#" class="btn-expand" onclick="expandCard()">Agregar monto</a>
            </div>

            {{-- DAILY EXPENSES BOOTSTRAP --}}
            <div class="accordion" id="chato-perro">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <div class="info">
                                <span class="danger">Hoy:</span>
                                <span class="text-light">${{ $currentExpenses }}</span>
                                <i class='bx bx-chevron-down'></i>
                            </div>
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <h2>Hoy compraste:</h2>
                            <ol>
                                @foreach ($shoppingToday as $item)
                                    <?php //$copAmount = number_format($item->price, 0, ',', ',');
                                    ?>
                                    <li>
                                        <div class="name-price">
                                            <p>x</p>
                                            <span>{{ $item->name }}</span>
                                            <span class="price">${{ formatCOP($item->price) }}</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- registrar una compra --}}
        <section id="add-purchase">
            <div class="info-purchase">
                <h2>Añade una compra</h2>
            </div>

            {{-- <form id="expense-form" action="{{ route('expenses.store')}}" method="POST" > --}}
            <form id="expense-form" method="POST">
                @csrf
                <input type="text" name="name" id="name" placeholder="Nombre">
                <input type="text" inputmode="numeric" name="price" class="price" placeholder="Precio" required>
                <input type="hidden" name="category" id="category">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <div id="message"></div>
            </form>

        </section>



        {{-- Modal de categorias --}}
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
    </div>
@endsection

@push('scripts')
    {{-- Formatear el dinero (INT) a cop EN TIEMPO REAL --}}
    <script src="{{ asset('js/formatCOP.js') }}"></script>
    {{-- Mover contenido cuando sale el teclado --}}
    <script src="{{ asset('js/moveContentToSeeBetter.js') }}"></script>

    {{-- Ajax para insertar --}}
    <script>
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
                    url: '{{ route('expenses.store') }}',
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
    </script>
@endpush
