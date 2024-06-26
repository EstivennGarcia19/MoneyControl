@extends('Layouts.html')
@extends('Layouts.nav.nav-bar')

@section('tittle-head')
    My Chest
@endsection

<?php $copAmount = number_format($info_chest->amount, 0, ',', ','); ?>

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
                        <button href="#"><i class='bx bx-trash'></i><span>Delete</span></button>
                    </form>
                    {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#selectColor"><i class='bx bx-brush-alt'></i><span>Edit</span></a> --}}
                </article>
            </div>


        </section>

        {{-- Tarjeta principal del dinero actual  --}}
        <article id="avabilable-balance">
            <div class="amount">
                <span>Aveilable Balance</span>
                <h2>${{ $copAmount }}</h2>
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
                <span>Activity</span>
            </article>

            <section id="my-chests">
                @foreach ($stalker as $joe)
                    <?php $copAmount = number_format($joe->amount, 0, ',', ','); ?>

                    <div class="history">
                        <article class="info">

                            @if ($joe->action_per == 'Removed')
                                <div class="icon cRed">
                                    <i class='bx bx-left-top-arrow-circle bx-rotate-90'></i>
                                </div>
                                <div class="date-state cRed">
                                    <h3>{{ $joe->action_per }}</h3>
                                    <span>{{ $joe->created_at }}</span>
                                </div>
                            @endif

                            @if ($joe->action_per == 'Added')
                                <div class="icon">
                                    <i class='bx bx-left-top-arrow-circle bx-rotate-270'></i>
                                </div>
                                <div class="date-state">
                                    <h3>{{ $joe->action_per }}</h3>
                                    <span>{{ $joe->created_at }}</span>
                                </div>
                            @endif


                        </article>

                        @if ($joe->action_per == 'Removed')
                            <article class="amount">
                                <span>- ${{ $copAmount }}</span>
                            </article>
                        @endif
                        @if ($joe->action_per == 'Added')
                            <article class="amount">
                                <span>${{ $copAmount }}</span>
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
                        <h1 class="modal-title fs-5" id="addAmount">Add money</h1>
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
                                    <input type="text" placeholder="Amount" inputmode="numeric" class="price"
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
                        <h1 class="modal-title fs-5" id="removeAmount">Remove Money</h1>
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
                                    <input type="text" placeholder="Amount" inputmode="numeric" class="price"
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
                        <div class="d-flex justify-content-around colors-chests">
                            <div class="color-circle bg-primary" data-color="primary"></div>
                            <div class="color-circle bg-secondary" data-color="secondary"></div>
                            <div class="color-circle bg-success" data-color="success"></div>
                            <div class="color-circle bg-danger" data-color="danger"></div>
                            <div class="color-circle bg-warning" data-color="warning"></div>
                            <div class="color-circle bg-info" data-color="info"></div>
                        </div>                    
                    </div>                                            
                        <button type="button" class="btn btn-primary" id="applyColorBtn">Aplicar Color</button>                    
                </div>
                


            </div>
        </div>
    </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('js/formatCOP.js') }}"></script>
    {{-- Script para selecciona color --}}
    <script>
         $(document).ready(function () {
            var selectedColor = null;

            $('.color-circle').on('click', function () {
                $('.color-circle').removeClass('selected');
                $(this).addClass('selected');
                selectedColor = $(this).data('color');
            });

            $('#applyColorBtn').on('click', function () {
                if (selectedColor) {
                    window.location.href = `/apply-color/${selectedColor}`;
                } else {
                    alert('Por favor, selecciona un color.');
                }
            });
        });
    </script>
@endpush
