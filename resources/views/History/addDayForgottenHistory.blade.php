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
            <div class="tittle"><span>Agregar compra</span></div>
            <div class="invisible">
                <p>p</p>
            </div>
        </article>



        {{-- CONTENDERO --}}
        <section id="list-history">

            <p>Si olvidaste anotar un gasto aqui puedes seleccionar el dia y anotarlo facilmente</p>

            <form id="forgotten-day" action="{{ route('history.addforgottenDay') }}" method="POST">
                {{-- token para seguridad --}}
                @csrf
                {{-- token para seguridad --}}
                <input type="text" name="name" placeholder="Nombre" required>
                <input type="text" inputmode="numeric" name="price" class="price" placeholder="Precio" required>
                <input type="date" name="date" placeholder="Selecciona una fecha ->"  required>
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                <button>Agregar</button>

                {{-- <button>Add</button> --}}
            </form>
        </section>


    </section>
@endsection

@push('scripts')
<script src="{{ asset('js/formatCOP.js')}}"></script>
@endpush
