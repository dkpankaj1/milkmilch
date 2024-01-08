<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\OtpService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Support\Facades\Redirect;
use App\Notifications\SendChangePasswordNotification;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View
    {
        return view('auth.reset-password', ['request' => $request]);
    }


    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'otp' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $otpService = new OtpService();
        $otpValidationResult = $otpService->validate($request->email, $request->otp);

        if ($otpValidationResult->status) {
            $user = User::where('email', $request->email)->first();

            if ($user) {
                $this->resetUserPassword($user, $request->password);
                $user->notify(new SendChangePasswordNotification($user));
                return Redirect::route('login')->with(['success' => "Your password has been changed successfully"]);
            }

            return Redirect::back()->with(['error' => 'User not found']);
        }

        return Redirect::back()->with(['error' => $otpValidationResult->message]);
    }

    protected function resetUserPassword(User $user, string $password): void
    {
        $user->forceFill([
            'password' => Hash::make($password),
        ])->setRememberToken(Str::random(60));

        $user->save();
    }



}