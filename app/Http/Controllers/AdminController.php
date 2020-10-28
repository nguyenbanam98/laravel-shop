<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function login()
    {
        if (auth()->check()) {
            return redirect()->to('home');
        }
        return view('admin.login');
    }

    public function postLogin(Request $request)
    {
        // return redirect()->to('home');
        // // dd($request->all());
        $remember = $request->has('remember_me') ? true : false;

        if (auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ], $remember)) {

            return redirect()->to('home');
        }

    }
}
