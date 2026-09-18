<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{

    // Halaman Login
    public function login()
    {
        return view('auth.login');
    }



    // Proses Login
    public function prosesLogin(Request $request)
{

    $request->validate([
        'username'=>'required',
        'password'=>'required'
    ]);


    if(Auth::attempt([
        'username'=>$request->username,
        'password'=>$request->password
    ])){


        return redirect('/dashboard');


    }


    return back()->with('error','Login gagal');

}




    // Dashboard
    public function dashboard()
    {

        return view('dashboard');

    }





    // Logout
    public function logout(Request $request)
    {

        Auth::logout();


        $request->session()->invalidate();


        $request->session()->regenerateToken();


        return redirect()
            ->route('login');

    }


}