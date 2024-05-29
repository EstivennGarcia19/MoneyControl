@extends('Layouts.html')
@extends('Layouts.nav.nav-bar')

<?php 
    use Carbon\Carbon;
    $date_month = $date_tittle->first()->date
 ?>


@section('principal-container')
    <section id="home-history">


        {{-- TITULO SECCION --}}
        <article id="section-tittle-history">
            <div class="back" onclick="back()"><i class='bx bx-chevron-left'></i></div>
            <div class="tittle"><span>{{Carbon::parse($date_month)->format('F')}}</span></div>
            <div class="invisible">
                <p>p</p>
            </div>
        </article>


        <section id="days-container">

            @foreach ($collection as $item)
            <?php 
                $copAmount = number_format($item->total, 0, ',', ',');
                $day_number = Carbon::parse($item->date)->formatLocalized('%d')
             ?>            
            <div class="day">
                <a href="{{ route('history.detailDay', ['day'=>$item->date]) }}">
                    <h2>{{$day_number}}</h2>
                    <span>${{$copAmount}}</span>    
                </a>
            </div>
                
            @endforeach
          

        </section>

        



     


       


    </section>
@endsection
