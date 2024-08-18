@extends('Layouts.html')
@extends('Layouts.nav.nav-bar')
@section('tittle-head')
    Ingresos
@endsection

@section('principal-container')
    <section id="home-history">


        {{-- TITULO SECCION --}}
        <article id="section-tittle-history">
            <div class="back" onclick="back()"><i class='bx bx-chevron-left'></i></div>
            <div class="tittle"><span>Ingresos registrados</span></div>
            <div class="invisible">
                <p>p</p>
            </div>
        </article>



        {{-- CONTENDERO --}}
        <section id="list-history">

            <p>Esos han sido tus ingresos</p>


            @if ($incomes->isEmpty())
                <section class="there-nothing">
                    <span class="text-danger">Aun no tienes ingresos</span>
                    <img src="{{ asset('media/nothing4.png') }}" alt="">
                </section>
            @else
                @foreach ($incomes as $item)
                    <?php $copAmount = number_format($item->amount, 0, ',', ','); ?>
                    <div class="history">
                        <article class="info">

                            <div class="icon text-light">
                                <i class='bx bx-message-square-detail'></i>
                            </div>
                            <div class="date-state">
                                {{-- <h3 class="text-light">{{ Carbon::parse($item->date)->formatLocalized('%A %d %B %Y') }}</h3> --}}
                                <h3 class="text-light">{{ formatFullDate($item->date) }}</h3>
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
