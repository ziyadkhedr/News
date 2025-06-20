<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            "title"=> ["required",'string','min:2','max:50'],
            'description'=>['required','string','min:10'],
            'category_id'=> ['exists:categories,id'],
            'comment_able'=> ['in:on,off'],
            'images'=> ['nullable'],
            'images.*'=> ['image','mimes:png,jpg'],
        ];
    }
}
