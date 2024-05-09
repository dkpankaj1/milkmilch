<?php

namespace App\Http\Requests\Web\Backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;
class CustomerUpdateRequest extends FormRequest
{
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
            'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->customer->user)],
            'phone' => ['required'],
            // 'address' => ['required','string'],
            // 'city' => ['required','string'],
            // 'state' => ['required','string'],
            // 'postal_code' => ['required','string'],
            // 'status' => ['required','numeric'],
            'assign_to' => ['required',Rule::exists(User::class,'id')]
        ];
    }
}
