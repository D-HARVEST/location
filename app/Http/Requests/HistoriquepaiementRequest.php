<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HistoriquepaiementRequest extends FormRequest
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
			'louerchambre_id' => 'required',
			'datePaiement' => 'required',
			'quittanceUrl' => 'nullable|mimes:jpeg,png,jpg,gif,svg,pdf',
			'montant' => 'required',
			'modePaiement' => 'required|string',
			'idTransaction' => 'nullable|string',
			'moisPaiement' => 'nullable|array',
			'user_id' => 'required',
        ];
    }
}
