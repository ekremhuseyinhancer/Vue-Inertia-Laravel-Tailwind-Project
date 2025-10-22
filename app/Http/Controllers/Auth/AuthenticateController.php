<?php

namespace App\Http\Controllers\Auth;

use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthenticateController extends Controller
{
    public function create(){
        return Inertia::render('Auth/Login',['status'=> session('status')]);
    }
    public function store(Request $request){
         $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended();

        }
        return back()->withErrors([
            'email' => 'The email or password you entered is incorrect',
        ])->onlyInput('email');
    }
    public function destroy(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect()->intended('dashboard');
    }

}
