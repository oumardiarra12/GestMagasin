<?php

namespace App\Http\Requests\Devis;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDevisRequest extends FormRequest
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
            "total_devis"=>"required|numeric",
            "date_devis"=>"required|date",
            "client_id"=>"required",
            "description_devis"=>"nullable",
            "quantite_lignedevis.*"=>"required|numeric",
            "prixvente_lignedevis.*"=>"required|numeric",
            "soustotal_lignedevis.*"=>"required|numeric",
            "produit_id.*"=>"required"
        ];
    }
}
