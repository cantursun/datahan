<?php

namespace App\Http\Requests\Site\Message;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
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
            'name'=>'required|string|max:75',
            'email'=>'required|email|max:75',
            'message'=> 'required|min:5|max:500',
        ];
    }

    public function attributes():array
    {
        return [
            'name'=>'Adınız',
            'email'=>'Email',
            'message'=>'Mesaj',
        ];
    }
}
