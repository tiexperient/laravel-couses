<?php

namespace App\Http\Controllers;

use App\Http\Requests\BatchesRequest;
use App\Models\Course;
use App\Models\CourseBatch;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BatchesController extends Controller
{
    // Listar Turmas do Curso
    public function index(Course $course)
    {
        // Recuperar os registros do banco de dados
        $batches = CourseBatch:: orderBy('id', 'DESC')
        ->where('course_id', $course->id)
        ->paginate(3);

        // Salvar Log
        Log:: info('Listagem de turmas', ['action_user_id' => Auth::id()]);

        // Carregar a view
        return view('batches.index', [
            'batches' => $batches,
            'course' => $course // ⭐ AQUI ESTÁ A SOLUÇÃO
        ]);
    }

    // Visualizar Turma
    public function show(CourseBatch $batches)
    {
        // Salvar Log
        Log:: info('Visualização da turma', ['Identificação' => $batches->id]);

        // Carregar a view
        return view('batches.show', ['batches' => $batches]);
    }

    // Adicionar Turma do Curso
    public function create(Course $course)
    {
        // Carregar a view
        return view('batches.create', ['course' => $course]);
    }

    // Adicionar Turma do Curso
    public function store(BatchesRequest $request)
    {
        // Capturar as possíveis exceções durante a execução
        try {
        // Cadastrar no Banco de Dados
        $batches = CourseBatch::create([
            'name' => $request->name,
            'course_id' => $request->course_id, // ⭐ OBRIGATÓRIO AGORA
        ]);

        // Salvar Log
        Log:: info('Criação de turma', ['Identificação' => $batches->id]);

        //Redirecionar o usuário, enviar a mensagem de sucesso
        return redirect()->route('batches.show', ['batches' => $batches->id])->with('success', 'Turma cadastrada com sucesso!');
        } catch (Exception $e) {

            // Salvar Log
            Log:: notice('Turma não cadastrada', ['Erro' => $e->getMessage()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Turma não cadastrada!');
        }
    }

    // Carregar o formulário de editar turma
    public function edit(CourseBatch $batches)
    {
        // Carregar a view
        return view('batches.edit', ['batches' => $batches]);
    }

    // Editar no banco de dados da turma
    public function update(BatchesRequest $request, CourseBatch $batches)
    {
        // Capturar as possíveis exceções durante a execução
        try {
        // Editar as informações do registro no banco de dados
        $batches -> update([
            'name' => $request -> name
        ]);

        // Salvar Log
        Log:: info('Edição de turma', ['Identificação' => $batches->id]);

        // Redirecionar o usuário, enviar mensagem de sucesso
        return redirect()->route('batches.show', ['batches' => $batches->id])->with('success', 'Turma atualizada com sucesso!');
        } catch (Exception $e) {

            // Salvar Log
            Log:: notice('Turma não editada', ['Erro' => $e->getMessage()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Turma não editada!');
        }
    }

    // Excluir o turma do banco de dados
    public function destroy(CourseBatch $batches)
    {
        // Capturar possíveis exceções durante a execução
        try {

            // Excluir o registro do banco de dados
            $batches->delete();

            // Salvar Log
            Log:: info('Turma apagada', ['Identificação' => $batches->id]);

            // Redirecionar o usuário, enviar mensagem de sucesso
            return redirect()->route('batches.index')->with('success', 'Turma excluída com sucesso!');
        } catch (Exception $e) {

            // Salvar Log
            Log:: notice('Turma não apagada', ['Erro' => $e->getMessage()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Turma não excluída!');
        }
    }
}
