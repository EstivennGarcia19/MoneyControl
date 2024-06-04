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
                <input type="text" inputmode="numeric" name="price" class="price" placeholder="Price" required>
                <input type="date" name="date" required>
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                <button>Add Day</button>

                {{-- <button>Add</button> --}}
            </form>









        </section>


    </section>
@endsection

@push('scripts')
<script src="{{ asset('js/formatCOP.js')}}"></script>
@endpush
