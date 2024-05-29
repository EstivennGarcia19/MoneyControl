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
                        <img src="https://i.pinimg.com/736x/0d/3f/5d/0d3f5d667fe30966f1c0e4e5c1cac477.jpg" alt="">
                    </div>
                    <div class="name-user">
                        <span><strong>Welcome!</strong></span><br>
                        <span class="user-name">{{Auth::user()->name}}</span>
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
                    <span>Aveilable Balance</span>
                    <h2>${{ $currentMoney }} COP</h2>
                </article>

                <button onclick="closeCard()" class="close-card">X</button>

                <form id="incomes-form" class="incomes-form" action="{{ route('incomes.store') }}" method="POST">
                    {{-- token para seguridad --}}
                    @csrf
                    {{-- token para seguridad --}}
                    <input type="text" name="amount" class="price" placeholder="¿How much bro?" required>
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <button class="btn-sent-income">Add amount</button>

                </form>
                <a href="#" class="btn-expand" onclick="expandCard()">Add amount</a>
            </div>

            {{-- DAILY EXPENSES BOOTSTRAP --}}
            <div class="accordion" id="chato-perro">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <div class="info">
                                <span class="danger">Today:</span>
                                <span class="text-light">${{ $currentExpenses }}</span>
                                <i class='bx bx-chevron-down'></i>
                            </div>
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <h2>You have bought these things Today</h2>
                            <ol>
                                @foreach ($shoppingToday as $item)
                                    <?php $copAmount = number_format($item->price, 0, ',', ','); ?>
                                    <li>
                                        <div class="name-price">
                                            <p>x</p>
                                            <span>{{ $item->name }}</span>
                                            <span class="price">${{ $copAmount }}</span>
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
                <h2>Add Purchase</h2>
                <p>¿What did you get today?</p>                
            </div>

            <form id="this-form" action="{{ route('expenses.store') }}" method="POST">
                {{-- token para seguridad --}}
                @csrf
                {{-- token para seguridad --}}
                <input type="text" name="name" id="name" placeholder="Full Name" required>                
                <input type="text" inputmode="numeric" name="price" class="price" placeholder="Price" required>                
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                @if (Session::has('message'))
                    <div class="catch-result">
                        <span class="message-catched">{{ Session::get('message') }}</span>
                    </div>
                @endif

                {{-- <button>Add</button> --}}
            </form>
        </section>
    </div>


    <!-- Agrega esta etiqueta script al final de tu archivo HTML justo antes del cierre del body -->
    <script></script>
@endsection

@push('scripts')
    <script src="{{ asset('js/formatCOP.js')}}"></script>
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
