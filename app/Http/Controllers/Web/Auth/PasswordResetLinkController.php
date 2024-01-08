<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Auth\PasswordForgotRequest;
use App\Models\User;
use App\Notifications\SendPasswordResetLink;
use App\Services\OtpService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
   
    public function create(): View
    {
        return view('auth.forgot-password');
    }

 
   function store(PasswordForgotRequest $request): RedirectResponse
    {
        $user = User::where('email', $request->input('email'))
            ->where('status', 1)
            ->first();

        if (!$user) {
            return back()->with(['error' => 'No user with that email address.']);
        }
       
        $otp = new OtpService();

        $user->notify(
            new SendPasswordResetLink(
                $otp->store($user->email),
                url('/reset-password?email='. $user->email)
            )
        );

        return back()->with(['success' => "We have send otp to your email. Please check your email and click on password reset link!"]);
    }
}
