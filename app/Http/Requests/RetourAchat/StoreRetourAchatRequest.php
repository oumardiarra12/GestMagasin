<?php

namespace App\Http\Requests\RetourAchat;

use Illuminate\Foundation\Http\FormRequest;

class StoreRetourAchatRequest extends FormRequest
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
            'total_retour_achat'=>"required",
            'description_retour_achat'=>'nullable',
            'date_retour_achat'=>'required|date',
            'quantite_retourligneAchat.*'=>'required|numeric',
            'prixachat_retourligneAchat.*'=>'required',
            'soustotal_retourligneAchat.*'=>'required',
            'produit_id.*'=>'required',

        ];
    }
}
