<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaisonRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
			'libelle' => 'required|string',
			'Pays' => 'required|string',
			'ville' => 'required|string',
			'quartier' => 'required|string',
			'adresse' => 'required|string',
			'jourPaiementLoyer' => 'required',
        ];
    }
}
