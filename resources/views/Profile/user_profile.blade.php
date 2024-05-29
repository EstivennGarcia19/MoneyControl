@extends('Layouts.html')
@section('tittle-head')
@extends('Layouts.nav.nav-bar')
    Profile
@endsection


@section('principal-container')
    <section id="profile">


        <section id="section-tittle-profile">
            <div class="back" onclick="back()"><i class='bx bx-chevron-left'></i></div>
        </section>
        <div class="tittle text-center">
            <h2>{{$user->name}}'s Profile</h2>
        </div>

        <article class="form-container">

            <form id="register-form" action="{{ route('login.login') }}" method="POST">

                @csrf
                <article id="photo-profile">
                    <div class="cont-img">                                                
                        <img src="https://i.pinimg.com/736x/0d/3f/5d/0d3f5d667fe30966f1c0e4e5c1cac477.jpg" alt="">
                    </div>
                </article>
                <input type="text" name="name" placeholder="UserName" required readonly value="{{$user->name}}">
                <input type="text" name="email" placeholder="Email" required readonly value="{{$user->email}}">            

                <a href="{{ route('profile.edit', $user) }}" class="btn-edit-profile">Edit Info</a>

                {{-- <button>Add</button> --}}
            </form>

        </article>
    </section>
@endsection
