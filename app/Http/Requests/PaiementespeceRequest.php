<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaiementespeceRequest extends FormRequest
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
			'Motif' => 'required|string',
			'Montant' => 'required',
			'Date' => 'required',
            'statut' => 'in:EN ATTENTE,CONFIRMER,REJETER',
            // 'DateReception' => 'required',
            'Mois' => 'required',
			'observation' => 'nullable|string',
			'louerchambre_id' => 'required',
        ];
    }
}
