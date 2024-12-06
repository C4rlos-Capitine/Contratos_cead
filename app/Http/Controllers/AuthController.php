<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function show()
    {
        return view('login_form');
    }

    public function login()
    {
        validator(request()->all(), [
            'email' => ['required', 'email'],
            'password' => ['required']
        ])->validate();
    
        if (auth()->attempt(
            request()->only(['email', 'password']), // Corrected order of fields
            request()->filled('remember')
        )) {
            return redirect()->route('main');
        }
    
        return redirect()->back()->withErrors(['email' => 'Credenciais inválidas!']);
    }
    

    public function logout(){
        auth()->logout();
        return redirect('/user_log');
    }

   
    
}
