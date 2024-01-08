<?php

namespace App\Http\Requests\Web\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class LogoutRequest extends FormRequest
{
    public function destroyAuthenticatedSession()
    {
        Auth::guard('web')->logout();

        $this->session()->invalidate();

        $this->session()->regenerateToken();
    }
}
