<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function postlogin(Request $req)
    {
        $req->validate([
            'email' => 'required|email',
            'password' => 'required|min:5'
        ]);

        if(Auth::attempt(['email' => $req->email, 'password' => $req->password]))
        {
            return redirect()->route('showprofile');

        }
        else{
            //return message
            $req->session()->flash('message', "Invalid Credentials");
            return redirect()->back();
        }


    }
    public function showregister()
    {
        return view('register');
    }

    public function postregister(Request $req)
    {
        $req->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5'
        ]);

        
        $user = new User();
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->save();
        $req->session()->flash('message', "Register Successfully");
        return redirect('/');


    }
}
