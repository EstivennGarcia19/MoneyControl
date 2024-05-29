@extends('Layouts.html')
@extends('Layouts.nav.nav-bar')
@section('tittle-head')
    Add Day
@endsection

<?php
use Carbon\Carbon;
?>


@section('principal-container')
    <section id="home-history">


        {{-- TITULO SECCION --}}
        <article id="section-tittle-history">
            <div class="back" onclick="back()"><i class='bx bx-chevron-left'></i></div>
            <div class="tittle"><span>Add a forgotten day</span></div>
            <div class="invisible">
                <p>p</p>
            </div>
        </article>



        {{-- CONTENDERO --}}
        <section id="list-history">

            <p>If you forgot to add a day, you can add it here.</p>







            <form id="forgotten-day" action="{{ route('history.addforgottenDay') }}" method="POST">
                {{-- token para seguridad --}}
                @csrf
                {{-- token para seguridad --}}

                <input type="text" name="name" placeholder="Full Name" required>
                <input type="text" name="price" class="price" placeholder="Price" required>
                <input type="date" name="date" placeholder="Date" required>
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                <button>Add Day</button>

                {{-- <button>Add</button> --}}
            </form>






            {{-- @if ($thisIncomes->isEmpty())
                <section class="there-nothing">
                    <span class="text-danger">No incomes yet</span>
                    <img src="{{ asset('media/nothing4.png') }}" alt="">
                </section>
            @else
                @foreach ($thisIncomes as $item)
                    <?php $copAmount = number_format($item->amount, 0, ',', ','); ?>
                    <div class="history">
                        <article class="info">

                            <div class="icon">
                                <i class='bx bx-message-square-detail'></i>
                            </div>
                            <div class="date-state">
                                <h3>{{ Carbon::parse($item->date)->formatLocalized('%A %d %B %Y') }}</h3>

                            </div>

                        </article>

                        <article class="amount income">
                            <span>${{ $copAmount }}</span>
                        </article>

                    </div>
                @endforeach
            @endif --}}



        </section>


    </section>
@endsection

@push('scripts')
<script src="{{ asset('js/formatCOP.js')}}"></script>
@endpush
