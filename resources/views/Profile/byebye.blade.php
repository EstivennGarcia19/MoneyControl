@extends('Layouts.html')


@section('principal-container')

<section id="byebye">

    <h1>A...a...adios! T_T</h1>

    <p>Que le vaya bien :)</p>

    <article class="cont-img">
        <img src="{{ asset('media/byebye.png') }}" alt="Adios bro">
    </article>

    <div class="btn">
        <a href="{{ route('welcome') }}">Bye</a>
    </div>
</section>
@endsection