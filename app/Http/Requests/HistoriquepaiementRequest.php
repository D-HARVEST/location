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
			'louerchambres_id' => 'required',
			'datePaiement' => 'required',
			'quittanceUrl' => 'nullable|string',
			'montant' => 'required',
			'modePaiement' => 'nullable|string',
			'idTransaction' => 'nullable|string',
			'moisPaiement' => 'required',
			'user_id' => 'required',
        ];
    }
}
