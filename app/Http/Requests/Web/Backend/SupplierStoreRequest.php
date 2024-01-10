<?php

namespace App\Http\Requests\Web\Backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class SupplierStoreRequest extends FormRequest
{
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['required'],
            'address' => ['required','string'],
            'city' => ['required','string'],
            'state' => ['required','string'],
            'postal_code' => ['required','string'],
            'status' => ['required','numeric'],
        ];
    }

    public function generatePassword(){
        return Str::random(8);
    }
}
