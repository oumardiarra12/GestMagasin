<?php

namespace App\Http\Requests\CategorieDepense;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrUpdateCategorieDepenseRequest extends FormRequest
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
           'nom_categorie_depense'=>'required',
           'description_categorie_depense'=>'nullable'
        ];
    }
}
