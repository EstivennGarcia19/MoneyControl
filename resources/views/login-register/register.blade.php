@extends('Layouts.html')
@section('tittle-head')
    Register
@endsection


@section('principal-container')
    <section id="register">


        <section id="section-tittle-login">
            <div class="back" onclick="back()"><i class='bx bx-chevron-left'></i></div>            
        </section>
        <div class="tittle">
            <h2>Register</h2>
        </div>

        <article class="form-container">

            <form id="register-form"  action="{{ route('login.register') }}" method="POST">
                @csrf              
                <input type="text" name="name" placeholder="UserName" required>
                <input type="text" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Create a password" required>

                <button>Register</button>

                <article class="redirect-lr">
                    <a href="{{ route('login.index_login') }}">Login</a>
                </article>

                {{-- <button>Add</button> --}}
            </form>

        </article>
    </section>
@endsection
