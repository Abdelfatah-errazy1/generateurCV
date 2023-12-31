<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddlangueRequest extends FormRequest
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
            'code' => 'required|string|max:10',
            'nom' => 'required|string|max:100',
            'flag' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    
        ];
    }
}
