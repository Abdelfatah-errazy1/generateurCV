<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddExperienceRequest extends FormRequest
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
            'profil' => 'nullable|string|max:150',
            'titrePoste' => 'required|string|max:150',
            'missionP' => 'required|string|max:150',
            'dateDebut' => 'nullable|date',
            'dateFin' => 'nullable|date|after:dateDebut',
            'entreprise' => 'required|string|max:255',
            'adresse' => 'nullable|string|max:255',
            'ville' => 'nullable|string|max:100',
            'pays' => 'nullable|string|max:50',
            'type' => 'nullable|string|max:20',
            'logoEntreprise' => 'nullable|max:255',
            'jointureDip' => 'nullable|max:255',
        ];
    }

    /***
     * Validate image required
     * @param $name
     * @return string
     */

}
