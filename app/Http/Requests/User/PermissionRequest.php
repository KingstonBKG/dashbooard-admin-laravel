<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'authorize_notification' => 'required|boolean', 
        ];
    }

        public function messages()
    {
        return [
            'authorize_notification.required' => "Ce champ ne peut pas être vide",
            'authorize_notification.boolean' => "Type non reconnu"
        ];
    }
}
