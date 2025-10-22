<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;


class EmailVerificationController extends Controller
{
    public function notice() {
        return Inertia::render('Auth/EmailVerification',['status'=> session('status')]);
    }

    public function handler(EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('home');
    }

    function resend (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('status', 'Verification link sent!');
    }
}
