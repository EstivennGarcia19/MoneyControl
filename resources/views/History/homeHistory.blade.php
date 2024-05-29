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



        {{-- OPSIONES --}}
        <section id="items">
            <a href="{{ route('histoty.incomes') }}">
                <article class="item">
                    <div class="info">
                        <div class="icon-container">
                            <i class='bx bx-receipt'></i>
                        </div>
                        <div class="info-details">
                            <h2>Incomes</h2>
                            <span>Your Incomes Registered</span>
                        </div>
                    </div>
                    <div class="arrow">
                        <i class='bx bx-chevron-right'></i>
                    </div>
                </article>
            </a>    
        </section>

        <section id="items">
            <a href="{{ route('history.forgottenDay') }}">
                <article class="item item-2">
                    <div class="info">
                        <div class="icon-container">
                            <i class='bx bx-time-five'></i>
                        </div>
                        <div class="info-details">
                            <h2>Forgotten day?</h2>
                            <span>Register one day</span>
                        </div>
                    </div>
                    <div class="arrow">
                        <i class='bx bx-chevron-right'></i>
                    </div>
                </article>
            </a>    
        </section>
      


        <section id="months-containers">

            @foreach ($collection as $item)
            <?php $copAmount = number_format($item->total, 0, ',', ','); ?>

            
            <div class="month">

                <a href="{{ route('history.daysExpenses', ['month'=>$item->month, 'date'=>$item->date]) }}">

                    <div class="tittle-month">
                        <span>{{Carbon::parse($item->date)->formatLocalized('%B')}}</span>
                        
                    </div>
    
                    <div class="details-month">
                        <span class="text-light">Total Bills</span>
                        <h2>{{$copAmount}}</h2>
                    </div>
                </a>

                {{-- <div class="decoration-left"></div>
                <div class="decoration-right"></div> --}}
            </div>
                
            @endforeach    
        </section>


    </section>
@endsection

@push('scripts')
<script>







</script>
    
@endpush
