@extends('Layouts.html')
@section('tittle-head')
@extends('Layouts.nav.nav-bar')
    Profile
@endsection


@section('principal-container')
    <section id="profile">


        <section id="section-tittle-profile">
            <div class="back" onclick="back()"><i class='bx bx-chevron-left'></i></div>
            <div class="tittle text-center">
                <h2>Mi perfil</h2>
            </div>
            <p>x</p>
        </section>

        <article class="form-container">

            <form class="register-form" action="{{ route('login.login') }}" method="POST">

                @csrf
                <article id="photo-profile">
                    <div class="cont-img">                                                
                        <img src="https://i.pinimg.com/originals/ef/e0/7d/efe07d9af104f338df556f48ba20ad62.png" alt="">
                    </div>
                </article>
                <input type="text" name="name" placeholder="UserName" required readonly value="{{$user->name}}">
                <input type="text" name="email" placeholder="Email" required readonly value="{{$user->email}}">            

                <a href="{{ route('profile.edit', $user) }}" class="btn-edit-profile">Actualizar datos</a>

                {{-- <button>Add</button> --}}
            </form>

        </article>
    </section>
@endsection
