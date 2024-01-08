<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LogoutRequest extends FormRequest
{
    public function destroyAuthenticatedToken(){

        // $this->user()->currentAccessToken()->delete();
        $this->user()->tokens()->delete();

    }
}
