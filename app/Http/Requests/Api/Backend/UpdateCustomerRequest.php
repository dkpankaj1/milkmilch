<?php

namespace App\Http\Requests\Api\Backend;

use App\Traits\HttpResponses;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
            'phone' => ['sometimes'],
            'address' => ['sometimes', 'string'],
            'city' => ['sometimes', 'string'],
            'state' => ['sometimes', 'string'],
            'postal_code' => ['sometimes', 'string'],
        ];
    }

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        return $this->sendHttpResponseException('validation error.', $validator->errors());
    }
}
