@extends('Layouts.html')
@extends('Layouts.nav.nav-bar')

<?php
// Se hace la llamada a esta api para formatear la fecha mas abajo en este archivo
use Carbon\Carbon;

?>




@section('principal-container')
    <section id="home-history">


        {{-- TITULO SECCION --}}
        <article id="section-tittle-history">
            <div class="back" onclick="back()"><i class='bx bx-chevron-left'></i></div>
            <div class="tittle"><span>Control History</span></div>
            <div class="invisible">
                <p>p</p>
            </div>
        </article>

        <section id="months-containers">

            @foreach ($collection as $item)
                <div class="month">

                    <a href="{{ route('history.daysExpenses', ['month' => $item->month, 'date' => $item->date]) }}">

                        <div class="tittle-month">
                            <span>{{ formatMonthDate($item->date) }}</span>

                        </div>

                        <div class="details-month">
                            <span class="text-light">Gastato este mes</span>
                            <h2>{{ formatCOP($item->total) }}</h2>
                        </div>
                    </a>
                </div>
            @endforeach
        </section>



        {{-- OPSIONES --}}
        <section id="container-items">

            <article class="items">
                <a href="{{ route('histoty.incomes') }}">
                    <article class="item">
                        <div class="info">
                            <div class="icon-container">
                                <i class='bx bx-money'></i>
                            </div>
                            <div class="info-details">
                                <h2>Mis ingresos</h2>
                                <span>Tus ingresos registrados</span>
                            </div>
                        </div>
                        <div class="arrow">
                            <i class='bx bx-chevron-right'></i>
                        </div>
                    </article>
                </a>
            </article>

            <article class="items">
                <a href="{{ route('history.categoriesHome') }}">
                    <article class="item">
                        <div class="info">
                            <div class="icon-container">
                                <i class='bx bxs-collection'></i>
                            </div>
                            <div class="info-details">
                                <h2>Categoria de gastos</h2>
                                <span>Revisar categorias</span>
                            </div>
                        </div>
                        <div class="arrow">
                            <i class='bx bx-chevron-right'></i>
                        </div>
                    </article>
                </a>
            </article>

            <article class="items">
                <a href="{{ route('history.forgottenDay') }}">
                    <article class="item item-2">
                        <div class="info">
                            <div class="icon-container">
                                <i class='bx bx-time-five'></i>
                            </div>
                            <div class="info-details">
                                <h2>Olvidé un dia</h2>
                                <span>Registra un dia</span>
                            </div>
                        </div>
                        <div class="arrow">
                            <i class='bx bx-chevron-right'></i>
                        </div>
                    </article>
                </a> 
            </article>

        </section>
    </section>
@endsection
