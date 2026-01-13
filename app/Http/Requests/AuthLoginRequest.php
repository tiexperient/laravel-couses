<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthLoginRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer esta requisição
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Retorna as regras de validação aplicáveis a requisição
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     * Regras de validação.
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    /**
     * Define mensagens personalizadas para regras de validação
     *
     * @return array<string, string> Mensagens de erro personalizadas
     * Regras de validação.
     */
    public function messages(): array
    {
        return [
             'email.required' => "Campo email é obrigatório!",
             'email.email' => "Necessário informar um email válido!",
             'password.required' => "Campo senha é obrigatório!",
        ];
    }
}
