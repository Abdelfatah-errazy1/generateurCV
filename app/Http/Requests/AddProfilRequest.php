<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddProfilRequest extends FormRequest
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
            'cin' => 'required|string|max:15|unique:profils,cin,except,id',
            'nom' => 'required|string|max:150',
            'prenom' => 'required|string|max:150',
            'genre' => 'required|string|max:2|' . Rule::in(['H', 'F']),
            'civilite' => 'nullable|string|max:5|'. Rule::in(['C', 'M','D','V']),
            'dateNaissance' => 'nullable|date',
            'titre' => 'required|string|max:255',
            'sousTitre' => 'nullable|string|max:255',
            'avatar' => $this->image('avatar') . 'image|mimes:jpeg,png,jpg|max:2048',
            'gsm1' => ['required', 'regex:/^\+?[1-9]\d{1,14}$/'],
            'gsm2' => ['regex:/^\+?[1-9]\d{1,14}$/'],
            'email' => 'nullable|email|max:50',
            'linkden' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'siteWeb' => 'nullable|url',
            'adresse' => 'nullable|string|max:255',
            'ville' => 'nullable|string|max:100',
            'pays' => 'nullable|string|max:50',
            'observation' => 'nullable|string|max:255',
            'etat' => 'required|string|max:255',
        ];
    }

    /***
     * Validate image required
     * @param $name
     * @return string
     */
    private function image($name): string
    {
        return $this->request->get("$name-preview") !== null ? 'nullable|' : 'required|';
    }
}
