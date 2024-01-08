<?php

namespace App\Http\Requests\Auth\Api;

use App\Events\LoginEvent;
use App\Traits\HttpRateLimiter;
use App\Traits\HttpResponses;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class LoginRequest extends FormRequest
{
    use HttpResponses,HttpRateLimiter;
   /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator){
        return $this->sendHttpResponseException('validation error.', $validator->errors());
    }
    
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt( ['email' => $this->email,'password' => $this->password,'status' => 1], $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());
            $this->sendHttpResponseException("login errors",['email' => trans('auth.failed')],401);
        }
        
        event(new LoginEvent(Auth::user(),$this->ip(),$this->userAgent()));

        RateLimiter::clear($this->throttleKey());
    }

}
