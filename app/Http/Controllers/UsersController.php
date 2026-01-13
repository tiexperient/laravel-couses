<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UsersController extends Controller
{
    // Listar Usuários
    public function index()
    {
        // Recuperar os registros do banco de dados com paginação
        $users = User:: orderBy('id', 'DESC')->paginate(3);

        // Salvar Log
        Log:: info('Listagem de usuários', ['action_user_id' => Auth::id()]);

        // Carregar a view
        return view('users.index', ['users' => $users]);
    }

    // Visualizar Usuário
    public function show(User $user)
    {
        // Salvar Log
        Log:: info('Visualização do usuário', ['Identificação' => $user->id, 'action_user_id' => Auth::id()]);

        // Carregar a view
        return view('users.show', ['user' => $user]);
    }

    // Adicionar Usuários
    public function create()
    {
        // Carregar a view
        return view('users.create');
    }

    // Adicionar Usuários
    public function store(UserRequest $request)
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
        Log:: info('Criação de usuário', ['Identificação' => $user->id, 'action_user_id' => Auth::id()]);

        //Redirecionar o usuário, enviar a mensagem de sucesso
        return redirect()->route('users.show', ['user' => $user->id])->with('success', 'Usuário cadastrado com sucesso!');
        } catch (Exception $e) {

            // Salvar Log
            Log:: notice('Usuário não cadastrado', ['Erro' => $e->getMessage(), 'action_user_id' => Auth::id()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Usuário não cadastrado!');
        }
    }

    // Carregar o formulário de editar usuário
    public function edit(User $user)
    {
        // Carregar a view
        return view('users.edit', ['user' => $user]);
    }

    // Editar no banco de dados de usuários
    public function update(UserRequest $request, User $user)
    {
        // Capturar as possíveis exceções durante a execução
        try {
        // Editar as informações do registro no banco de dados
        $user -> update([
            'name' => $request -> name,
            'email' => $request->email,
        ]);

        // Salvar Log
        Log:: info('Edição de usuário', ['Identificação' => $user->id]);

        // Redirecionar o usuário, enviar mensagem de sucesso
        return redirect()->route('users.show', ['user' => $user->id])->with('success', 'Usuário atualizado com sucesso!');
        } catch (Exception $e) {

            // Salvar Log
            Log:: notice('Usuário não editado', ['Erro' => $e->getMessage()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Usuário não editado!');
        }
    }


    // Carregar o formulário de editar senha do usuário
    public function editPassword(User $user)
    {
        // Carregar a view
        return view('users.edit_password', ['user' => $user]);
    }

    // Editar no banco de dados a senha do usuário
    public function updatePassword(Request $request, User $user)
    {
        // Validar o Formulário com Módulo de tradução pt-BR
        $request->validate([
            'password' => 'required|confirmed|min:6',
        ],
        [
            'password.required' => "Campo senha é obrigatório!",
            'password.min' => "Senha com no mínimo :min caracteres!",
            'password.confirmed' => "A confirmação da senha não corresponde",
        ]
        );

        // Capturar as possíveis exceções durante a execução
        try {
        // Editar as informações do registro no banco de dados
        $user -> update([
            'password' => $request -> password,
        ]);

        // Salvar Log
        Log:: info('Senha do usuário editada', ['Identificação' => $user->id]);

        // Redirecionar o usuário, enviar mensagem de sucesso
        return redirect()->route('users.show', ['user' => $user->id])->with('success', 'Senha de Usuário atualizada com sucesso!');
        } catch (Exception $e) {
            
            // Salvar Log
            Log:: notice('Senha de usuário não editada', ['Erro' => $e->getMessage()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Senha do Usuário não editada!');
        }
    }

    // *******************************************************************************
    // Excluir usuário do banco de dados
    public function destroy(User $user)
    {
        // Capturar possíveis exceções durante a execução
        try {

            // Excluir o registro do banco de dados
            $user->delete();

            // Salvar Log
            Log:: info('Usuário apagado', ['Identificação' => $user->id]);

            // Redirecionar o usuário, enviar mensagem de sucesso
            return redirect()->route('users.index')->with('success', 'Usuário excluído com sucesso!');
        } catch (Exception $e) {

            // Salvar Log
            Log:: notice('Usuário não apagado', ['Erro' => $e->getMessage()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Usuário não excluído!');
        }
    }
}