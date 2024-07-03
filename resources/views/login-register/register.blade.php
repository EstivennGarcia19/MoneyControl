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
            <h2>Regístrate</h2>
        </div>

        <article class="form-container">

            <form id="register-form"  action="{{ route('login.register') }}" method="POST">
                @csrf              
                <input type="text" name="name" placeholder="UserName" required>
                <input type="text" name="email" placeholder="Correo" required>
                <input type="password" name="password" placeholder="Crea una contraseña" required>

                <button>Registrarme</button>

                <article class="redirect-lr">
                    <a href="{{ route('login.index_login') }}">Iniciar sesion</a>
                </article>

                {{-- <button>Add</button> --}}
            </form>

        </article>
    </section>
@endsection
