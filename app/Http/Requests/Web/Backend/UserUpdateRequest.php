<?php

namespace App\Http\Requests\Web\Backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;
class UserUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user)],
            'phone' => ['required'],
            'address' => ['required','string'],
            'city' => ['required','string'],
            'state' => ['required','string'],
            'postal_code' => ['required','string'],
            'status' => ['required','numeric'],
        ];
    }
}
