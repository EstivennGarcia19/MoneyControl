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
                        <img src="https://i.pinimg.com/originals/ef/e0/7d/efe07d9af104f338df556f48ba20ad62.png"
                            alt="">
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
                            <h2>Haz comprado estas cosas hoy:</h2>
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
                <h2>Añadir una compra</h2>
                <p>¿Que compraste hoy?</p>
            </div>

            {{-- action="{{ route('expenses.store') }}" --}}
            <form id="this-form" action="{{ route('expenses.store')}}" method="POST" >
                {{-- token para seguridad --}}
                @csrf
                <input type="text" name="name" id="name" placeholder="Nombre" required>
                <input type="text" inputmode="numeric" name="price" class="price" placeholder="Precio" required>
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                @if (Session::has('message'))
                    <div class="catch-result">
                        <span class="message-catched">{{ Session::get('message') }}</span>
                    </div>
                @endif

            </form>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/formatCOP.js') }}"></script>
    {{-- Esto es para que cuando salga el teclad el contenido se mueva hacia arriba y 
        no quede tapado por el teclado del celular --}}
    <script>
        $(document).ready(function() {
            // Agrega un controlador de eventos focus a todos los campos de entrada
            $('input, textarea').focus(function() {
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
    </script>
@endpush
