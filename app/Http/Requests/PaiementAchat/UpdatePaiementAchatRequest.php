<?php

namespace App\Http\Requests\PaiementAchat;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaiementAchatRequest extends FormRequest
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
            'total_achat'=>'required',
            'total_payer'=>'required',
            'total_reste'=>'required',
            'date_paiement_achat'=>'required',
            'description_paiement'=>'nullable'
        ];
    }
}
