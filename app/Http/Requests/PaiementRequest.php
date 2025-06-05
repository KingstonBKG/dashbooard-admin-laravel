<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaiementRequest extends FormRequest
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
            'moyen' => 'required|in:orange_money,mobile_money,bank_card',
            'statut' => 'nullable|in:valide,en_attente,echec',
            'type' => 'required|in:deposit,withdraw',
            'tontine_id' => 'required|exists:tontines,id',
            'user_id' => 'required|exists:users,id',
            'destinataire_id' => 'nullable|exists:users,id',
            'montant' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'utilisateur requis',
            'user_id.exists' => 'utilisateur introuvable',
            'destinataire_id.exists' => 'destinataire introuvable',
            'tontine_id.required' => 'tontine_id requis',
            'tontine_id.exists' => 'tontine_id introuvable',
            'moyen.in' => 'methode de paiement inconnue',
            'type.in' => 'type inconnue',
        ];
    }
}
