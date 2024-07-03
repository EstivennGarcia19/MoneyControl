@extends('Layouts.html')

@section('principal-container')

<div id="welcome">

    <div id="hero">
        <img src="{{ asset('media/hero2.svg') }}" alt="">
    </div>

    <article class="information">
        <h2>Money Control</h2>
        <p>Para que tengas en cuenta en que tanto gastas la plata</p>
    </article>

    <article class="btn-container">
        <a href="{{ route('login.index_login') }}" class="active">Iniciar sesion</a>
        <a href="{{ route('login.index_register') }}">Registrarse</a>
    </article>

</div>
    
@endsection