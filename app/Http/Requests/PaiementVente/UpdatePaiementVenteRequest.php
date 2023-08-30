<?php

namespace App\Http\Requests\PaiementVente;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaiementVenteRequest extends FormRequest
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
            'total_vente'=>'required',
            'total_payer'=>'required',
            'total_reste'=>'required',
            'date_paiement_vente'=>'required',
            'description_paiement'=>'nullable'
        ];
    }
}
