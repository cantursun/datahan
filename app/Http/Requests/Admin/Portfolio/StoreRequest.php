<?php

namespace App\Http\Requests\Admin\Portfolio;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
    public function rules():array
    {
        return [
            'title'=>'required|string|max:255',
            'description'=>'string|nullable|max:2000',
            'is_published'=>'required|in:0,1',
            //'slug' => 'nullable|unique:abouts|max:255',
        ];
    }

    public function attributes():array
    {
        return [
            'title'=>'Başlık',
            'description'=>'Açıklama',
            'is_published'=>'Yayınlanma',
            //'slug' => 'nullable|unique:abouts|max:255',
        ];
    }
}
