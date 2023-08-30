<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            "nom_user"=>"required",
            "prenom_user"=>"required",
            "photo_user"=>"nullable",
            "telephone_user"=>"required",
            "adresse_user"=>"required",
            'email'=>'required|unique:users,email,id',
            'password'=>'required'
        ];
    }
}
