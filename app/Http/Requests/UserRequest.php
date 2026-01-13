<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Contracts\Service\Attribute\Required;

class UserRequest extends FormRequest
{
    /**
     * Define se o usuário está autorizado a fazer esta requisição
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Retorna as regras de validação aplicáveis a requisição
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     * Regras de validação
     */
    public function rules(): array
    {
        $user = $this->route('user');

        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . ($user ? $user->id : null),
            'password' => 'required_if:password,!=null|confirmed|min:6',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => "Campo nome é obrigatório!",
            'email.required' => "Campo email é obrigatório!",
            'email.email' => "Necessário informar um email válido!",
            'email.unique' => "Email já cadastrado na plataforma!",
            'password.required' => "Campo senha é obrigatório!",
            'password.confirmed' => "A confirmação da senha não corresponde",
            'password.min' => "Senha com no mínimo :min caracteres!"
        ];
    }
}
