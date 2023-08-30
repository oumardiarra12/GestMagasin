<?php

namespace App\Http\Requests\Produit;

use Illuminate\Foundation\Http\FormRequest;

class StoreProduitRequest extends FormRequest
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
            'codebarre'=>'nullable',
            'nom_produit'=>'required',
            'stockmin'=>'required|numeric',
            'prixvente_produit'=>'required|numeric',
            'prixachat_produit'=>'required|numeric',
            'description_produit'=>'nullable',
            'famille_id'=>'required',
            'unite_id'=>'required'
        ];
    }
}
