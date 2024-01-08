<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\PasswordResetRequest;
use App\Models\User;
use App\Notifications\SendChangePasswordNotification;
use App\Services\OtpService;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class NewPasswordController extends Controller
{
    use HttpResponses;
    public function store(PasswordResetRequest $request)
    {
        $user = User::where('email', $request->email)
        ->where('status',1)
        ->first();

        if (!$user) {
            return $this->sendError("No user with that email address.",[], 404);
        }

        $otpService = new OtpService();
        $otpValidationResult = $otpService->validate($user->email, $request->otp);

        if ($otpValidationResult->status) {

            $this->resetUserPassword($user, $request->password);
            $user->notify(new SendChangePasswordNotification($user));
            return $this->sendSuccess(trans('profile.password.success'),[],200);
        }

        return $this->sendError($otpValidationResult->message,[], 401);

    }

    protected function resetUserPassword(User $user, string $password): void
    {
        $user->forceFill([
            'password' => Hash::make($password),
        ])->setRememberToken(Str::random(60));

        $user->save();
    }
}
