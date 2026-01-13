<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusUserRequest;
use App\Models\Status;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class StatusUserController extends Controller
{
    // Listar Status do Usuário
    public function index()
    {
        // Recuperar os registros do banco de dados
        $status_user = Status:: orderBy('id', 'DESC')->paginate(3);

        // Salvar Log
        Log:: info('Listagem de status de usuários', ['action_user_id' => Auth::id()]);

        // Carregar a view
        return view('status-user.index', ['status_user' => $status_user]);
    }

    // Visualizar Status do Usuário
    public function show(Status $status_user)
    {
        // Salvar Log
        Log:: info('Visualização de status do usuário', ['Identificação' => $status_user->id]);

        // Carregar a view
        return view('status-user.show', ['status_user' => $status_user]);
    }

    // Adicionar Status do Usuário
    public function create()
    {
        // Carregar a view
        return view('status-user.create');
    }

    // Adicionar Status do Usuário
    public function store(StatusUserRequest $request)
    {
        // Capturar as possíveis exceções durante a execução
        try {
        // Cadastrar no Banco de Dados
        $status_user = Status::create([
            'name' => $request->name
        ]);

        // Salvar Log
        Log:: info('Criação status de usuário', ['Identificação' => $status_user->id]);

        //Redirecionar o usuário, enviar a mensagem de sucesso
        return redirect()->route('status-user.show', ['status_user' => $status_user->id])->with('success', 'Status de usuário cadastrado com sucesso!');
        } catch (Exception $e) {

            // Salvar Log
            Log:: notice('Status de usuário não cadastrado', ['Erro' => $e->getMessage()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Status de Usuário não cadastrado!');
        }
    }

    // Carregar o formulário de editar status de usuário
    public function edit(Status $status_user)
    {
        // Carregar a view
        return view('status-user.edit', ['status_user' => $status_user]);
    }

    // Editar no banco de dados de status dos usuários
    public function update(StatusUserRequest $request, Status $status_user)
    {
        // Capturar as possíveis exceções durante a execução
        try {
        // Editar as informações do registro no banco de dados
        $status_user -> update([
            'name' => $request -> name
        ]);

        // Salvar Log
        Log:: info('Edição de status de usuário', ['Identificação' => $status_user->id]);

        // Redirecionar o usuário, enviar mensagem de sucesso
        return redirect()->route('status-user.show', ['status_user' => $status_user->id])->with('success', 'Status de usuário atualizado com sucesso!');
        } catch (Exception $e) {

            // Salvar Log
            Log:: notice('Status de usuário não editado', ['Erro' => $e->getMessage()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Status de Usuário não editado!');
        }
    }

    // Excluir status de usuário do banco de dados
    public function destroy(Status $status_user)
    {
        // Capturar possíveis exceções durante a execução
        try {

            // Excluir o registro do banco de dados
            $status_user->delete();

            // Salvar Log
            Log:: info('Status de usuário apagado', ['Identificação' => $status_user->id]);

            // Redirecionar o usuário, enviar mensagem de sucesso
            return redirect()->route('status-user.index')->with('success', 'Status de Usuário excluído com sucesso!');
        } catch (Exception $e) {

            // Salvar Log
            Log:: notice('Status de usuário não apagado', ['Erro' => $e->getMessage()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Status de Usuário não excluído!');
        }
    }
}
