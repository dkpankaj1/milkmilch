<?php

namespace App\Http\Requests\Api\Auth;

use App\Traits\HttpRateLimiter;
use App\Traits\HttpResponses;
use Illuminate\Validation\Rules;
use Illuminate\Foundation\Http\FormRequest;

class PasswordResetRequest extends FormRequest
{
    use HttpResponses, HttpRateLimiter;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'otp' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator){
        $this->sendHttpResponseException('validation error.', $validator->errors());
    }
}
