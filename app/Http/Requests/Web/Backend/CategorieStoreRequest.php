<?php

namespace App\Http\Requests\Web\Backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CategorieStoreRequest extends FormRequest
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
            "name" => ["required", "string", "max:255"],
            "description" => ["required", "string", "max:255"],
            "slug" => ["required", "string", "max:255","unique:categories,slug"],
            "status" => ["required"],
        ];
    }
    public function prepareForValidation(){
        return $this->merge([
            'slug' => Str::slug($this->name, '-'),
        ]);
    }
}
