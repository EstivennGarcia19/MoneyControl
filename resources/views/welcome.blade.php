@extends('Layouts.html')

@section('principal-container')

<div id="welcome">

    <div id="hero">
        <img src="{{ asset('media/hero2.svg') }}" alt="">
    </div>

    <article class="information">
        <h2>Money Control</h2>
        <p>Track your expenses and realize what you do with your money</p>
    </article>

    <article class="btn-container">
        <a href="{{ route('login.index_login') }}" class="active">Loguin</a>
        <a href="{{ route('login.index_register') }}">Register</a>
    </article>

</div>
    
@endsection