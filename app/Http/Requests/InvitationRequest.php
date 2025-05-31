<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvitationRequest extends FormRequest
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
            'expediteur_id' => 'required|exists:users,id',
            'destinataire_email' => 'required|email|exists:users,email',
            'tontine_id' => 'required|exists:tontines,id',
            'statut' => 'in:en_attente,accepte,refuse'
        ];
    }

    public function messages()
    {
        return [
            'expediteur_id.required' => 'l\'identifiant de l\'expediteur est requis',
            'expediteur_id.exists' => 'l\'identifiant de l\'expediteur doit exister',
            'destinataire_email.required' => 'l\'email du destinateur est requis',
            'tontine_id.required' => 'l\'identifiant de la tontine est requis',
            'tontine_id.exists' => 'la tontine doit exister',
            'statut.in' => 'le statut est invalide'
        ];
    }
}
