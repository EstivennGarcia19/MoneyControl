@extends('Layouts.html')
@extends('Layouts.nav.nav-bar')

<?php
use Carbon\Carbon;
?>


@section('principal-container')
    <section id="home-history">


        {{-- TITULO SECCION --}}
        <article id="section-tittle-history">
            <div class="back" onclick="back()"><i class='bx bx-chevron-left'></i></div>
            <div class="tittle"><span>Incomes Registered</span></div>
            <div class="invisible">
                <p>p</p>
            </div>
        </article>



        {{-- CONTENDERO --}}
        <section id="list-history">

            <p>You've register these Incomes</p>


            @if ($thisIncomes->isEmpty())
                <section class="there-nothing">
                    <span class="text-danger">No incomes yet</span>
                    <img src="{{ asset('media/nothing4.png') }}" alt="">
                </section>
            @else
                @foreach ($thisIncomes as $item)
                    <?php $copAmount = number_format($item->amount, 0, ',', ','); ?>
                    <div class="history">
                        <article class="info">

                            <div class="icon text-light">
                                <i class='bx bx-message-square-detail'></i>
                            </div>
                            <div class="date-state">
                                <h3 class="text-light">{{ Carbon::parse($item->date)->formatLocalized('%A %d %B %Y') }}</h3>

                            </div>

                        </article>

                        <article class="amount income">
                            <span>${{ $copAmount }}</span>
                        </article>

                    </div>
                @endforeach
            @endif



        </section>


    </section>
@endsection
