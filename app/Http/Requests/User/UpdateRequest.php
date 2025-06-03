<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'username' => 'nullable|string|max:20',
            // 'email' => 'required|email|unique:users,email,'.$this->route('id'),
            'password' => 'nullable|string|confirmed|min:8',
            'password_confirmation' => 'required_with:password',
            'organization' => 'nullable|string',
            'phoneNumber' => 'nullable|string',
            'address' => 'nullable|string',
            'country' => 'nullable|string',
            'language' => 'nullable|string',
            'timeZones' => 'nullable|string',
            'currency' => 'nullable|string',  
            'image' => 'image|max:2000|nullable',  
        ];
    }


    public function messages()
    {
        return [
            // 'email.email' => "Entrer une adresse email valide",
            'image.max' => "L'image doit être de inférieure ou égale à 2mo"
        ];
    }
}
