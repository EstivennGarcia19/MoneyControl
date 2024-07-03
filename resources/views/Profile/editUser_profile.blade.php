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
                <h2>Editar Perfil</h2>
            </div>
            <p>x</p>
        </section>
        

        <article class="form-container">

            <form class="register-form" action="{{ route('profile.update', $user) }}" method="POST">6
                @csrf
                @method('PUT')
                <article id="photo-profile">
                    <div class="cont-img">
                        <img src="https://i.pinimg.com/originals/ef/e0/7d/efe07d9af104f338df556f48ba20ad62.png"
                            alt="">
                    </div>
                </article>
                <input type="text" name="name" placeholder="UserName" required value="{{ $user->name }}">
                <input type="text" name="email" placeholder="Email" required value="{{ $user->email }}">

                <button class="btn btn-success p-3 mb-3">Actualizar</button>
            </form>
            {{-- Formulario para eliminar --}}
            <form class="d-flex flex-column" action="{{ route('user.destroy', $user) }}" method="POST"
                id="form-delete-user">
                @csrf
                @method('DELETE')
                <button form="form-delete-user" class="btn btn-danger p-3" onclick="return confirm('¿Are you sure bro?')"
                    type="submit">Eliminar cuenta</button>
            </form>

        </article>
    </section>
@endsection
