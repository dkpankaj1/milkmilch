<?php

namespace App\Http\Requests\Web\Backend;

use App\Models\Categorie;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

use Illuminate\Validation\Rule;

class CategorieUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            "name" => ["required", "string", "max:255"],
            "description" => ["required", "string", "max:255"],
            "slug" => ["required", "string", "max:255",Rule::unique(Categorie::class)->ignore($this->category->id)],
            "status" => ["required"],
        ];
    }
    public function prepareForValidation(){
        return $this->merge([
            'slug' => Str::slug($this->name, '-'),
        ]);
    }
}
