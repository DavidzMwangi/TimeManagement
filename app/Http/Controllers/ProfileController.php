<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profileView()
    {
        return view('backend.user.profile')->withUser(Auth::user());
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'password'=>'required|confirmed'
        ]);

        $user=Auth::user();
        $user->name=$request->name;
        $user->password=bcrypt($request->password);
        $user->save();


        return response()->json(Auth::user());
    }

    public function authUser()
    {
        return response()->json(Auth::user());
    }
}
