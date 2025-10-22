<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;



class RegisterController extends Controller
{
    public function create(){
        return Inertia::render('Auth/Register');

    }
    public function store(Request $request){
        sleep(1);

        $credentials= $request->validate([
            'name'=> 'required|max:255',
            'email'=> 'required|lowercase|email|max:255|min:3',
            'password'=> 'required|confirmed|min:6|max:32',
            'password_confirmation'=> 'required|same:password',
        ]);
        $user = User::create($credentials);

        event(new Registered($user));
        Auth::login($user);

        return redirect()->route('home');
    }
}
