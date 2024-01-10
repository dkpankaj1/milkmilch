<?php

namespace App\Http\Requests\Api\Backend;

use App\Traits\HttpResponses;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;

class SupplierUpdateRequest extends FormRequest
{
    use HttpResponses;
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
            'name' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->supplier->user)],
            'phone' => ['sometimes'],
            'address' => ['sometimes','string'],
            'city' => ['sometimes','string'],
            'state' => ['sometimes','string'],
            'postal_code' => ['sometimes','string'],
            'status' => ['sometimes','numeric'],
        ];
    }
    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        return $this->sendHttpResponseException('validation error.', $validator->errors());
    }
}
