<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function show($id) {

        $user = User::where('id', $id)->first();
    
        return view('Profile.user_profile', compact('user'));

    }


    public function edit( $id)
    {
        //
        $user = User::where('id', $id)->first();
        return view('Profile.editUser_profile', compact('user'));
    }



    public function update(Request $request, User $user) {
                
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        $user = User::where('id', $user->id)->first();
        
        return view('Profile.user_profile', compact('user'));
    }
}
