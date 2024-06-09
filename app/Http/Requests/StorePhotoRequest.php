<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePhotoRequest extends FormRequest
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
            
            'title' => 'required',
            'image' => 'required|image|max:1000',
            'description' => 'nullable',
            'categories' => 'exists:categories,id',
            'best_shoot_id' => 'exists:best_shoots,id'
 
        ];
    }
}
