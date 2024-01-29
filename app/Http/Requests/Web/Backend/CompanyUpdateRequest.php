<?php

namespace App\Http\Requests\Web\Backend;

use Illuminate\Foundation\Http\FormRequest;

class CompanyUpdateRequest extends FormRequest
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
            "name" => ['required', 'string'],
            "email" => ['required', 'string', 'email'],
            "phone" => ['required', 'string'],
            "address" => ['required', 'string'],
            "city" => ['required', 'string'],
            "state" => ['required', 'string'],
            "postal_code" => ['required', 'string'],
            "country" => ['required', 'string'],
            "gst_number" => ['required', 'string'],
            "pan_number" => ['required', 'string'],
            "upi" => ['required', 'string'],
            "upi_barcode" => ['sometimes','mimes:jpg,png'],
            "website" => ['required', 'string',],
            "logo" => ['sometimes','mimes:jpg,png'],
            "fevicon" => ['sometimes','mimes:jpg,png'],
            'currencies_id' => ['required', 'string', 'exists:currencies,id'],
        ];
    }
}
