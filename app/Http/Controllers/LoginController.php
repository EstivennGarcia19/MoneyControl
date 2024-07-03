<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //
    public function index_login()
    {

        return view('login-register.login');
    }
    public function index_register()
    {

        return view('login-register.register');
    }


    public function register(Request $request)
    {

        $credentials = $request->only('email');

        $user = User::where('email', $credentials['email'])->first();

        if ($user) {

            return redirect()->route('login.index_login')->withErrors(['email' => "Este correo ya existe"]);
        } else {

            $user = new User;

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);

            $user->save();

            Auth::login($user);

            return redirect()->route('home.index');
        }
    }

    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');

        $remember = $request->has('remember');

        // Se crea variable para buscar al usuario que se quiere loguear
        $user = User::where('email', $credentials['email'])->first();

        // Si el usuaio no se encuntra la base de datos
        if ($user) {

            if (hash::check($credentials['password'], $user->password)) {

                if (Auth::attempt($credentials, $remember)) {

                    $request->session()->regenerate();

                    return redirect()->route('home.index');
                }
            } else {

                return redirect()->back()->withErrors(['password' => "Ups! Contraseña incorrecta"]);
            }
        } else {

            return redirect()->back()->withErrors(['email' => "Este correo no existe en la base de datos"]);
        }

    }


    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return view('welcome');
    }


}
