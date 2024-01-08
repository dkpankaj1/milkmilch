<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Api\PasswordForgotRequest;
use App\Models\User;
use App\Notifications\SendPasswordResetOtp;
use App\Services\OtpService;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;

class PasswordResetOtpController extends Controller
{
    use HttpResponses;
    function store(PasswordForgotRequest $request): JsonResponse
    {
        $request->ensureIsNotRateLimited();

        $user = User::where('email', $request->input('email'))
            ->where('status', 1)
            ->first();


        if (!$user) {
            return $this->sendError("No user with that email address.", [],404);
        }

       
        $otp = new OtpService();

        $user->notify(
            new SendPasswordResetOtp(
                $otp->store($user->email)
            )
        );

        return $this->sendSuccess("OTP Generated", ["email" => $request->email]);
    }
}
