<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Web\PasswordResetRequest;
use App\Models\User;
use App\Notifications\SendPasswordResetLink;
use App\Services\OtpService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(PasswordResetRequest $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

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
