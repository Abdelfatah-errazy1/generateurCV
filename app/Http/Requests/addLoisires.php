<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addLoisires extends FormRequest
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
        // dd(request());
        return [
            'logo' => 'image|mimes:jpeg,png,jpg|max:2048',
            'titre' => 'required|max:150',
            'description' => 'nullable',
            'profil' => 'nullable',
        ];
    }
    private function image($name): string
    {
        return $this->request->get("$name-preview") !== null ? 'nullable|' : 'required|';
    }
}
