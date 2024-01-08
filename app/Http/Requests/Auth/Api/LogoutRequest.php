<?php

namespace App\Http\Requests\Auth\Api;

use Illuminate\Foundation\Http\FormRequest;

class LogoutRequest extends FormRequest
{
    public function destroyAuthenticatedToken(){

        // $this->user()->currentAccessToken()->delete();
        $this->user()->tokens()->delete();

    }
}
