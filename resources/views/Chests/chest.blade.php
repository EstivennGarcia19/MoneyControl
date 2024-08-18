@extends('Layouts.html')
@extends('Layouts.nav.nav-bar')

@section('tittle-head')
    My Chest
@endsection


@section('principal-container')
    <section id="bg-container" style="background-color:{{ $info_chest->color }} ">

        {{-- Titulo de la seccion --}}
        <section id="section-tittle-chest">
            <div class="tittle">
                <div class="back" onclick="back()"> <i class='bx bx-chevron-left'></i></div>
            </div>
            <div class="tittle">
                <div><span>{{ $info_chest->name }}</span></div>
            </div>
            <div class="more-options" onclick="openOptions()">
                <i class='bx bx-dots-vertical-rounded'></i>
                <article class="options">
                    <form action="{{ route('chests.destroy', ['chest' => $info_chest->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Estas seguro que quieres borrar este cofre?')" ><i class='bx bx-trash'></i><span>Borrar</span></button>
                    </form>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#selectColor"><i
                            class='bx bx-brush-alt'></i><span>Editar</span></a>
                </article>
            </div>


        </section>

        {{-- Tarjeta principal del dinero actual  --}}
        <article id="avabilable-balance">
            <div class="amount">
                <span>Dinero disponible</span>
                <h2>${{ formatCOP($info_chest->amount) }}</h2>
            </div>
            <div class="options">
                <div class="add-money" data-bs-toggle="modal" data-bs-target="#addAmount">
                    <i class='bx bx-plus'></i>
                </div>
                <div class="remove-money" data-bs-toggle="modal" data-bs-target="#removeAmount">
                    <i class='bx bx-minus'></i>
                </div>

            </div>

        </article>

        <div id="history-chest">

            <article class="info-chest">
                <span>Actividad</span>
            </article>

            <section id="my-chests">
                @foreach ($stalker as $joe)
                    <div class="history">
                        <article class="info">

                            @if ($joe->action_per == 'Retirado')
                                <div class="icon cRed">
                                    <i class='bx bx-left-top-arrow-circle bx-rotate-90'></i>
                                </div>
                                <div class="date-state cRed">
                                    <h3>{{ $joe->action_per }}</h3>
                                    <span>{{ formatFullDate($joe->created_at) }}</span>
                                </div>
                            @endif

                            @if ($joe->action_per == 'Añadido')
                                <div class="icon">
                                    <i class='bx bx-left-top-arrow-circle bx-rotate-270'></i>
                                </div>
                                <div class="date-state">
                                    <h3>{{ $joe->action_per }}</h3>
                                    <span>{{ formatFullDate($joe->created_at) }}</span>
                                </div>
                            @endif


                        </article>

                        @if ($joe->action_per == 'Retirado')
                            <article class="amount">
                                <span>- ${{ formatCOP($joe->amount) }}</span>
                            </article>
                        @endif
                        @if ($joe->action_per == 'Añadido')
                            <article class="amount">
                                <span>${{ formatCOP($joe->amount) }}</span>
                            </article>
                        @endif
                    </div>
                @endforeach
            </section>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="addAmount" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="addAmountLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between">
                        <h1 class="modal-title fs-5" id="addAmount">Agregar dinero</h1>
                        <button type="button" class="btn text-light" data-bs-dismiss="modal"><i
                                class='bx bx-x'></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="my-content-modal">

                            <form action="{{ route('chest.add_amount', $info_chest) }}" method="POST">
                                @method('PUT')
                                @csrf
                                <article>
                                    <label for="input_add_amount"><img src="{{ asset('media/icon-addMoney3.png') }}"
                                            alt=""></label>
                                    <input type="hidden" placeholder="Name" name="name"
                                        value="{{ $info_chest->name }}">
                                    <input type="text" placeholder="Cantidad" inputmode="numeric" class="price"
                                        id="input_add_amount" name="amount" value="">
                                    <input type="hidden" placeholder="Date" name="date"
                                        value="{{ $info_chest->date }}">
                                </article>

                                <button><i class='bx bx-plus'></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="removeAmount" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="removeAmountLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between">
                        <h1 class="modal-title fs-5" id="removeAmount">Retirar dinero</h1>
                        <button type="button" class="btn text-light" data-bs-dismiss="modal"><i
                                class='bx bx-x'></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="my-content-modal">

                            <form action="{{ route('chest.remove_amount', $info_chest) }}" method="POST">
                                @method('put')
                                @csrf
                                <article>
                                    <label for="amount"><img src="{{ asset('media/icon-removeMoney.png') }}"
                                            alt=""></label>
                                    <input type="hidden" placeholder="Name" name="name"
                                        value="{{ $info_chest->name }}">
                                    <input type="text" placeholder="Cantidad" inputmode="numeric" class="price"
                                        name="amount" value="">
                                    <input type="hidden" placeholder="Date" name="date"
                                        value="{{ $info_chest->date }}">
                                </article>
                                <button><i class='bx bx-minus'></i> </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal cambio de colores --}}
        <div class="modal fade" id="selectColor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="selectColorLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between">
                        <h1 class="modal-title fs-5" id="selectColor">Select a color</h1>
                        <button type="button" class="btn text-light" data-bs-dismiss="modal"><i
                                class='bx bx-x'></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="my-content-modal">
                            <form
                                action="{{ route('chest.changeColor', ['chest' => $info_chest->id, 'color' => 'replace']) }}"
                                id="form-change-cc" method="POST">
                                @csrf
                                <div class="colors-chests">
                                    <div class="color-circle" style="background: #ff4b59"
                                        onclick="changeColor('ff4b59')">
                                    </div>
                                    <div class="color-circle" style="background: #1896fe"
                                        onclick="changeColor('1896fe')">
                                    </div>
                                    <div class="color-circle" style="background: #704df9"
                                        onclick="changeColor('704df9')">
                                    </div>
                                    <div class="color-circle" style="background: #ff5d2a"
                                        onclick="changeColor('ff5d2a')">
                                    </div>
                                    <div class="color-circle" style="background: #2bc2ff"
                                        onclick="changeColor('2bc2ff')">
                                    </div>
                                    <div class="color-circle" style="background: #000000"
                                        onclick="changeColor('000000')">
                                    </div>

                                    
                                    <div class="color-circle" style="background: #e64d3d"
                                        onclick="changeColor('e64d3d')">
                                    </div>
                                    <div class="color-circle" style="background: #f1c40f"
                                        onclick="changeColor('f1c40f')">
                                    </div>
                                    <div class="color-circle" style="background: #e39703"
                                        onclick="changeColor('e39703')">
                                    </div>
                                    <div class="color-circle" style="background: #ecdf5a"
                                        onclick="changeColor('ecdf5a')">
                                    </div>
                                    <div class="color-circle" style="background: #d5c41e"
                                        onclick="changeColor('d5c41e')">
                                    </div>
                                    <div class="color-circle" style="background: #2fcc71"
                                        onclick="changeColor('2fcc71')">
                                    </div>
                                    <div class="color-circle" style="background: #27ab60"
                                        onclick="changeColor('27ab60')">
                                    </div>
                                    <div class="color-circle" style="background: #78c9d0"
                                        onclick="changeColor('78c9d0')">
                                    </div>
                                    <div class="color-circle" style="background: #379fa8"
                                        onclick="changeColor('379fa8')">
                                    </div>
                                    <div class="color-circle" style="background: #344853"
                                        onclick="changeColor('344853')">
                                    </div>
                                    <div class="color-circle" style="background: #22374c"
                                        onclick="changeColor('22374c')">
                                    </div>
                                    <div class="color-circle" style="background: #1ba687"
                                        onclick="changeColor('1ba687')">
                                    </div>
                                    <div class="color-circle" style="background: #ff414d"
                                        onclick="changeColor('ff414d')">
                                    </div>
                                    <div class="color-circle" style="background: #f46a79"
                                        onclick="changeColor('f46a79')">
                                    </div>                                
                                    <div class="color-circle" style="background: #6ec6ca"
                                        onclick="changeColor('6ec6ca')">
                                    </div>
                                    
                                    
                                    
                                    
                                </div>
                            </form>
                            <button class="mt-5" form="form-change-cc">Change</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('js/formatCOP.js') }}"></script>
    <script src="{{ asset('js/changeColorChest.js') }}"></script>
@endpush
