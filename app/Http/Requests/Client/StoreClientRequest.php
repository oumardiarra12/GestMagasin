<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
            'nom_client'=>'required|string',
            'prenom_client'=>'required|string',
            'email_client'=>'required|email',
            'tel_client'=>'required|numeric',
            'adresse_client'=>'required',
            'description_client'=>'nullable'
        ];
    }
}
