<?php

namespace App\Http\Requests;

use App\Models\Profil;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfilRequest extends FormRequest
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
        $id=request('id');
        return [
        
            'cin' => ['required', 'max:10', 'string',  
            function ($attribute, $value, $fail) use ($id) { 
                $o = Profil::query()    
                                ->where(Profil::PK, '!=', $id)                         
                                ->where('cin', $value)                         
                                ->first();                      
                                if (isset($o)) {                         
                                    $fail(__('validation.unique', ['attribute' => $attribute]));                     
                                }                 
                            }],
            'nom' => 'required|string|max:150',
            'prenom' => 'required|string|max:150',
            'genre' => 'required|string|max:2|' . Rule::in(['H', 'F']),
            'civilite' => 'nullable|string|max:5|'. Rule::in(['C', 'M','D','V']),
            'dateNaissance' => 'nullable|date',
            'titre' => 'required|string|max:255',
            'sousTitre' => 'nullable|string|max:255',
            'avatar' => $this->image('avatar') . 'image|mimes:jpeg,png,jpg|max:2048',
            'gsm1' => 'required|string|max:15',
            'gsm2' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:50',
            'linkden' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'siteWeb' => 'nullable|string|max:255',
            'adresse' => 'nullable|string|max:255',
            'ville' => 'nullable|string|max:100',
            'pays' => 'nullable|string|max:50',
            'observation' => 'nullable|string|max:255',
            'etat' => 'required|string|max:255',
        ];
    }
    private function image($name): string
    {
        return $this->request->get("$name-preview") !== null ? 'nullable|' : 'required|';
    }
}
