<?php

namespace App\Http\Requests\Achat;

use Illuminate\Foundation\Http\FormRequest;

class StoreAchatRequest extends FormRequest
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
            "date_achat"=>"required|date",
            "total_achat"=>"required|numeric",
            "fournisseur_id"=>"required",
            "description_achat"=>"nullable",
            "status_achat_reception"=>"required",
            "quantite_ligneAchat.*"=>"required|numeric",
            "quantite_recu_ligneAchat.*"=>"required|numeric",
            "prixachat_ligneAchat.*"=>"required|numeric",
            "soustotal_ligneAchat.*"=>"required|numeric",
            "produit_id.*"=>"required",
            "achat_id.*"=>"required"
        ];
    }
}
