<?php

namespace App\Http\Requests\RetourVente;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRetourVenteRequest extends FormRequest
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
            'total_retourvente'=>"required",
            'description_retourvente'=>'nullable',
            'date_retourvente'=>'required|date',
            'quantite_ligneretourvente.*'=>'required|numeric',
            'prixvente_ligneretourvente.*'=>'required',
            'soustotal_ligneretourvente.*'=>'required',
            'produit_id.*'=>'required',
        ];
    }
}
