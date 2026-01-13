<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusCourseRequest;
use App\Models\CourseStatus;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class StatusCourseController extends Controller
{
    // Listar Status do Curso
    public function index()
    {
        // Recuperar os registros do banco de dados
        $status = CourseStatus:: orderBy('id', 'DESC')->paginate(3);

        // Salvar Log
        Log:: info('Listagem de status de cursos', ['action_user_id' => Auth::id()]);

        // Carregar a view
        return view('status-course.index', ['status' => $status]);
    }

    // Visualizar Status do Curso
    public function show(CourseStatus $status)
    {
        // Salvar Log
        Log:: info('Visualização de status do curso', ['Identificação' => $status->id]);

        // Carregar a view
        return view('status-course.show', ['status' => $status]);
    }

        // Adicionar Status do Curso
        public function create()
    {
        // Carregar a view
        return view('status-course.create');
    }

    // Adicionar Status do Curso
    public function store(StatusCourseRequest $request)
    {
        // Capturar as possíveis exceções durante a execução
        try {
        // Cadastrar no Banco de Dados
        $status = CourseStatus::create([
            'name' => $request->name
        ]);

        // Salvar Log
        Log:: info('Criação de status de curso', ['Identificação' => $status->id]);

        //Redirecionar o usuário, enviar a mensagem de sucesso
        return redirect()->route('status-course.show', ['status' => $status->id])->with('success', 'Status de curso cadastrado com sucesso!');
        } catch (Exception $e) {

            // Salvar Log
            Log:: notice('Status de curso não cadastrado', ['Erro' => $e->getMessage()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Status de Curso não cadastrado!');
        }
    }

    // Carregar o formulário de editar status do curso
    public function edit(CourseStatus $status)
    {
        // Carregar a view
        return view('status-course.edit', ['status' => $status]);
    }

    // Editar no banco de dados de Status de Curso
    public function update(StatusCourseRequest $request, CourseStatus $status)
    {
        // Capturar as possíveis exceções durante a execução
        try {
        // Editar as informações do registro no banco de dados
        $status -> update([
            'name' => $request -> name
        ]);

        // Salvar Log
        Log:: info('Edição de status de curso', ['Identificação' => $status->id]);

        // Redirecionar o usuário, enviar mensagem de sucesso
        return redirect()->route('status-course.show', ['status' => $status->id])->with('success', 'Status de curso atualizado com sucesso!');
        } catch (Exception $e) {

            // Salvar Log
            Log:: notice('Status do curso não editado', ['Erro' => $e->getMessage()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Status de Curso não editado!');
        }
    }

    // Excluir status de curso do banco de dados
    public function destroy(CourseStatus $status)
    {
        // Capturar possíveis exceções durante a execução
        try {

            // Excluir o registro do banco de dados
            $status->delete();

            // Salvar Log
            Log:: info('Status de curso apagado', ['Identificação' => $status->id]);

            // Redirecionar o usuário, enviar mensagem de sucesso
            return redirect()->route('status-course.index')->with('success', 'Status de Curso excluído com sucesso!');
        } catch (Exception $e) {

            // Salvar Log
            Log:: notice('Status de curso não apagado', ['Erro' => $e->getMessage()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Status de Curso não excluído!');
        }
    }
}