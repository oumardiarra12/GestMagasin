<?php

namespace App\Http\Requests\Famille;

use Illuminate\Foundation\Http\FormRequest;


class StoreFamilleRequest extends FormRequest
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
            'id'=>'nullable',
            "nom_famille"=>"required|string",
            "description_famille"=>"nullable"
        ];
    }
    // public function failedValidation(Validator $validator)

    // {

    //     throw new HttpResponseException(response()->json([

    //         'success'   => false,

    //         'message'   => 'Validation errors',

    //         'data'      => $validator->errors()

    //     ]));

    // }




}
