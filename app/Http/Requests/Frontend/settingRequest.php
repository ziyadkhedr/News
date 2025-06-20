<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class settingRequest extends FormRequest
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
            "name"=> ["min:2","required","max:40"],
            'username' => ['required','unique:users,username,'.auth()->user()->id],
            "email"=> ["email","required",'unique:users,email,'.auth()->user()->id],
            "phone"=> ["numeric","required",'unique:users,phone,'.auth()->user()->id],
            "country"=> ["min:2",'max:20',"required"],
            "street"=> ["min:2",'max:20',"required"],
            "iamge"=> ["nullable",'mimes:png,jpg','image'],
        ];
    }
}
