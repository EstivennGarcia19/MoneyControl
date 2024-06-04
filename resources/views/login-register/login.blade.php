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
            <h2>Log In</h2>
        </div>

        <article class="form-container">

            <form id="register-form" action="{{ route('login.login') }}" method="POST">
                @csrf
                {{-- Si el correo esta mal --}}
                @if ($errors->has('email'))
                    <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                @endif
                {{-- Si la contraseña esta mal --}}
                @if ($errors->has('password'))
                    <div class="alert alert-danger">{{ $errors->first('password') }}</div>
                @endif

                <input type="text" name="email" placeholder="Email" required value="{{ old('email') }}">
                <input type="password" name="password" placeholder="Create a password" required>
                <div class="rememberme">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember" class="text-light ms-2">Remember</label>
                </div>

                <button>Login</button>

                <article class="redirect-lr">
                    <a href="{{ route('login.index_register') }}">Are you new?</a>
                </article>

            </form>
        </article>
    </section>
@endsection
