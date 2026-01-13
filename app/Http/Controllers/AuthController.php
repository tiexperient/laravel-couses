<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterUserRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    // Login
    public function index()
    {
        // Carregar a VIEW
        return view('auth.login');
    }

    // Validar os dados do usuário no login
    public function loginProcess(AuthLoginRequest $request)
    {
        // Capturar possíveis exceções durante a execução
        try {
        // Validar o usuário e a senha com as informações do banco de dados
        $authenticated = Auth::attempt(['email' => $request->email, 'password' => $request->password]);

        // Verificar se o usuário foi autenticado
        if(!$authenticated){
            // Salvar Log
            Log:: notice('Email ou senha inválido!', ['email' => $request->email]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Email ou senha inválido!');
        }

            // Salvar Log
            Log:: info('Login', ['action_user_id' => Auth::id()]);

            // Redirecionar o usuário
            return redirect()->route('dashboard.index');

        } catch (Exception $e) {
            
            // Salvar Log
            Log:: notice('Dados do login incorreto.', ['Erro' => $e->getMessage()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Email ou senha inválido!');
        }
    }

    // Deslogar o usuário
    public function logout()
    {
        // Salvar log
        Log:: notice('Logout.', ['action_user_id' => Auth::id()]);

        // Deslogar o usuário
        Auth::logout();

        // Redirecionar o usuário, enviar mensagem de sucesso
        return redirect()->route('login')->with('success', 'Deslogado com sucesso!');

    }

    // Formulário cadastrar novo usuário
    public function create()
    {
        // Carregar a VIEW
        return view('auth.register');
    }

    // Cadastrar no Banco de dados o novo usuário
    public function store(AuthRegisterUserRequest $request)
    {
        // Capturar as possíveis exceções durante a execução
        try {
        // Cadastrar no Banco de Dados
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        // Salvar Log
        Log:: info('Criação de usuário', ['Identificação' => $user->id]);

        //Redirecionar o usuário, enviar a mensagem de sucesso
        return redirect()->route('login')->with('success', 'Cadastro realizado com sucesso!');
        } catch (Exception $e) {

            // Salvar Log
            Log:: notice('Usuário não cadastrado', ['Erro' => $e->getMessage()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Cadastro não cadastrado!');
        }
    }

}