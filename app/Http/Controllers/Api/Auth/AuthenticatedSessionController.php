<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\LogoutRequest;
use App\Http\Resources\UserResource;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    use HttpResponses;
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): JsonResponse
    {
        $request->authenticate();

        if (Auth::user()->currentAccessToken()) {
            Auth::user()->currentAccessToken()->delete();
        }

        $data = [
            'user' => new UserResource(Auth::user()),
            'token' => Auth::user()->createToken($request->throttleKey())->plainTextToken,
        ];

        return $this->sendSuccess("login success", $data, 200);

    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(LogoutRequest $request): JsonResponse
    {
        $request->destroyAuthenticatedToken();
        return $this->sendSuccess("logout success");
    }
}
