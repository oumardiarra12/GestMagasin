<?php

namespace App\Http\Requests\Fournisseur;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFournisseurRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nom_fournisseur'=>'required|string',
            'prenom_fournisseur'=>'required|string',
            'email_fournisseur'=>'required|email',
            'tel_fournisseur'=>'required|numeric',
            'adresse_fournisseur'=>'required',
            'description_fournisseur'=>'nullable'
        ];
    }
}
