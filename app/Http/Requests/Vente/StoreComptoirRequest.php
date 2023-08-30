<?php

namespace App\Http\Requests\Vente;

use Illuminate\Foundation\Http\FormRequest;

class StoreComptoirRequest extends FormRequest
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
            "total_vente"=>"required|numeric",
            //"date_vente"=>"required|date",
            "client_id"=>"required",
            //"description_vente"=>"nullable",
            "quantite_lignevente.*"=>"required|numeric",
            "prixvente_lignevente.*"=>"required|numeric",
            "soustotal_lignevente.*"=>"required|numeric",
            "produit_id.*"=>"required",
            // "vente_id.*"=>"required"
        ];
    }
}
