<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|min:5',
            'category' => 'required|exists:categories,id',
            'photos.*' => 'mimes:png,jpg|file|max:10000', //.* -> one by one inspection in array
            'description' => 'required',
            'feature_image' => 'nullable|mimes:png,jpg|file|max:10000',
        ];
    }
}
