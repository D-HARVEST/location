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
			'libelle' => 'nullable|string',
			'Pays' => 'nullable|string',
			'ville' => 'nullable|string',
			'quartier' => 'nullable|string',
            'pourcentage_special' => 'nullable|numeric|min:0|max:100',
            'date_fin_mois' => 'nullable',
			'adresse' => 'nullable|string',
			'jourPaiementLoyer' => 'nullable',
            'moyenPaiement_id' => 'nullable|exists:moyen_paiements,id',
        ];
    }
}
