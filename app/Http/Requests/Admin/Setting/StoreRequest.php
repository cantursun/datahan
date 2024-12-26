<?php

namespace App\Http\Requests\Admin\Setting;

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
            'title'=>'string|required|max:255',
            'type'=>'required|in:string,numeric,float,phone',
            'key' => 'required|unique:settings|max:255',
            'value' => 'nullable|max:500'
        ];
    }

    public function attributes():array
    {
        return [
            'title'=>'Başlık',
            'type'=>'Tipi',
            'key' => 'Ayar Anahtarı',
            'value' => 'Ayar Değeri'
        ];
    }
}
