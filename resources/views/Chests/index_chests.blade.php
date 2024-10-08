@extends('Layouts.html')
@extends('Layouts.nav.nav-bar')
@extends('Layouts.nav.btn-chests-nav')
@section('tittle-head') 
Chests
@endsection

<?php
// Se hace la llamada a esta api para formatear la fecha mas abajo en este archivo
use Carbon\Carbon;
Carbon::setLocale('es');

?>


@section('principal-container')
    <div id="chests">

        <section id="section-tittle-chest">
            <div class="back" onclick="back()"><i class='bx bx-chevron-left'></i></div>
            <div class="tittle"><span>Cofres</span></div>
            {{-- <div class="tittle"><span>Chests</span></div> --}}
            <div class="invisible">
                <p>XD</p>
            </div>

        </section>

        <article class="info-chests">
            {{-- <p>In this section you can create chests to store money for a specific thing or to track savings.</p> --}}
            <p>Crea cofres donde puedes guardar un monto especifico de dinero</p>
        </article>


        <section id="my-chests">

            @if ($myChests->isEmpty())

                <section class="there-nothing">
                    <span class="text-danger">No has creado un cofre aún</span>
                    <img src="{{ asset('media/nothing3.png') }}" alt="">
                </section>
            @else
                @foreach ($myChests as $chest)
                    <?php $copAmount = number_format($chest->amount, 0, ',', ','); ?>

                    <article class="chest" style="background-color:{{ $chest->color }}">

                        <a href="{{ route('chest.show', $chest->id) }}">

                            <div class="circle-chest">
                                <img src="{{ asset('media/cofre-icon3.png') }}" alt="">
                            </div>
    
                            <div class="tittle-chest">
                                <span>{{ $chest->name }}</span>
                            </div>
    
                            <div class="current-amount">
                                <span href="#">${{ $copAmount }}</span>
                            </div>
    
                            <div class="date-created">
                                <span>Creado</span>
                                {{-- <span>01 Feb</span> --}}
                                <span>{{ Carbon::parse($chest->date)->format('d M') }}
                                </span>
                            </div>
                        </a>
                    </article>
                @endforeach
            @endif

        </section>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h1 class="modal-title fs-5 text-light" id="addMoreAmountLabel">Nuevo cofre</h1>
                    <button type="button" class="btn text-light" data-bs-dismiss="modal"><i class='bx bx-x'></i></button>
                </div>
                <div class="modal-body">
                    <div class="my-content-modal">
                        <form id="form-chest" action="{{ route('chests.store') }}" method="POST">
                            {{-- token para seguridad --}}
                            @csrf
                            {{-- token para seguridad --}}
                            <input type="text" name="name" placeholder="Elige un nombre"> <br>
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <button type="submit" form="form-chest">Crear</button>
                        </form>

                    </div>

                </div>


            </div>
        </div>
    </div>
@endsection
