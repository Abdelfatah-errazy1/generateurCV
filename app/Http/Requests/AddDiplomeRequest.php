<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddDiplomeRequest extends FormRequest
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
            "titre" => 'required|max:255',
            "secteur" => 'required|integer',
            "profil" => 'nullable|integer',
            "niveau" => 'nullable|max:150',
            "score" => 'nullable',
            "mention" => 'nullable|max:100',
            "dateDebut" => 'required|date',
            "dateFin" => 'required|date|after:dateDebut',
            "organismeDelivreur" => 'required|max:150',
            "ville" => 'nullable|max:100',
            "pays" => 'nullable|max:50',
            "type " => 'nullable|max:20',
            "logoOrganisme" => 'nullable|max:255',
            "diplomeJoint" => 'nullable|max:255',
        ];
    }
}
