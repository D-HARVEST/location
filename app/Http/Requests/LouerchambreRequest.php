<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LouerchambreRequest extends FormRequest
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
            'user_id' => 'nullable',
            'chambre_id' => 'required',
            'debutOccupation' => 'nullable',
            'statut' => ['nullable', 'string', 'in:EN ATTENTE,CONFIRMER,REJETER,ARCHIVER'],
            'loyer' => 'nullable',
            'cautionLoyer' => 'nullable',
            'cautionElectricite' => 'nullable',
            'cautionEau' => 'nullable',
            'copieContrat' =>  'nullable|file|mimes:pdf,jpg,jpeg,png,svg',
            'jourPaiementLoyer' => 'nullable',
        ];
    }
}
