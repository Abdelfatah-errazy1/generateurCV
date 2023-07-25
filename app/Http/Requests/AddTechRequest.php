<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddTechRequest extends FormRequest
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
                'titre' => 'required|max:150',
                'logoTech' =>$this->image('avatar') . 'image|mimes:jpeg,png,jpg|max:2048',
                'description' => 'nullable',
                'experience' => 'nullable',
        ];
    }
    
    private function image($name): string
    {
        return $this->request->get("$name-preview") !== null ? 'nullable|' : 'required|';
    }
}
