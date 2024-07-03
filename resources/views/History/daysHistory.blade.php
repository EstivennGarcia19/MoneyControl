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
            <div class="tittle"><span>{{formatMonthDate($date_month)}}</span></div>
            <div class="invisible">
                <p>p</p>
            </div>
        </article>


        <section id="days-container">

            @foreach ($collection as $item)
            <?php 
                $day_number = Carbon::parse($item->date)->formatLocalized('%d')
             ?>            
            <div class="day">
                <a href="{{ route('history.detailDay', ['day'=>$item->date]) }}">
                    <h2>{{$day_number}}</h2>
                    <span>{{formatCOP($item->total)}}</span>    
                </a>
            </div>
                
            @endforeach
          
        </section>                
    </section>
@endsection
