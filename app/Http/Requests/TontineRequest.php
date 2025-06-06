<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TontineRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'contribution_amount' => 'required|numeric|min:0',
            'contribution_frequency' => 'required|in:hebdo,monthly,yearly,weekly,bi_weekly',
            'max_members' => 'required|integer|min:2',
            'startDate' => 'required|date',
            'type' => 'required|in:fixed,rotating,voting',
            'status' => 'nullable|in:active,completed',
            'random_draw' => 'boolean',
            'admin_id' => 'required|exists:users,id'
        ];
    }

    public function messages()
{
    return [
        'name.required' => 'Le nom de la tontine est obligatoire',
        'description.required' => 'La description est obligatoire',
        'contribution_amount.required' => 'Le montant de la contribution est obligatoire',
        'contribution_amount.numeric' => 'Le montant doit être un nombre',
        'contribution_amount.min' => 'Le montant doit être positif',
        'contribution_frequency.required' => 'La fréquence de contribution est obligatoire',
        'contribution_frequency.in' => 'La fréquence sélectionnée est invalide',
        'max_members.required' => 'Le nombre maximum de membres est obligatoire',
        'max_members.integer' => 'Le nombre de membres doit être un nombre entier',
        'max_members.min' => 'Le nombre minimum de membres est 2',
        'start_date.required' => 'La date de début est obligatoire',
        'startDate.date' => 'Format de date invalide',
        'type.required' => 'Le type de tontine est obligatoire',
        'type.in' => 'Le type sélectionné est invalide'
    ];
}
}
