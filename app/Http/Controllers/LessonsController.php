<?php

namespace App\Http\Controllers;

use App\Http\Requests\LessonRequest;
use App\Models\Lesson;
use App\Models\Module;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LessonsController extends Controller
{
    // Listar as Aulas dos Cursos
    public function index(Module $modules)
    {
        // Recuperar os registros do banco de dados
        $lessons = Lesson:: orderBy('id', 'DESC')
        ->where('module_id', $modules->id)
        ->paginate(3);

        // Salvar Log
        Log:: info('Listagem de aulas', ['action_user_id' => Auth::id()]);

        // Carregar a view
        return view('lessons.index', ['lesson' => $lessons]);
    }

    // Visualizar Aulas do Curso
    public function show(Lesson $lesson)
    {
        // Salvar Log
        Log:: info('Visualização da aula', ['Identificação' => $lesson->id]);

        // Carregar a view
        return view('lessons.show', ['lesson' => $lesson]);
    }

    // Adicionar as Aulas dos Cursos
    public function create()
    {
        // Carregar a view
        return view('lessons.create');
    }

    // Adicionar as Aulas dos Cursos
    public function store(LessonRequest $request)
    {
        // Capturar as possíveis exceções durante a execução
        try {
        // Cadastrar no Banco de Dados
        $lesson = Lesson::create([
            'name' => $request->name
        ]);

        // Salvar Log
        Log:: info('Criação de aula', ['Identificação' => $lesson->id]);

        //Redirecionar o usuário, enviar a mensagem de sucesso
        return redirect()->route('lessons.show', ['lesson' => $lesson->id])->with('success', 'Aula cadastrada com sucesso!');
        } catch (Exception $e) {

            // Salvar Log
            Log:: notice('Aula não cadastrada', ['Erro' => $e->getMessage()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Aula não cadastrada!');
        }
    }

    // Carregar o formulário de editar aulas
    public function edit(Lesson $lesson)
    {
        // Carregar a view
        return view('lessons.edit', ['lesson' => $lesson]);
    }

    // Editar no banco de dados das aulas
    public function update(LessonRequest $request, Lesson $lesson)
    {
        // Capturar as possíveis exceções durante a execução
        try {
        // Editar as informações do registro no banco de dados
        $lesson -> update([
            'name' => $request -> name
        ]);

        // Salvar Log
        Log:: info('Edição de aula', ['Identificação' => $lesson->id]);

        // Redirecionar o usuário, enviar mensagem de sucesso
        return redirect()->route('lessons.show', ['lesson' => $lesson->id])->with('success', 'Aula atualizada com sucesso!');
        } catch (Exception $e) {

            // Salvar Log
            Log:: notice('Aula não cadastrada', ['Erro' => $e->getMessage()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Aula não editada!');
        }
    }

    // Excluir o aula do banco de dados
    public function destroy(Lesson $lesson)
    {
        // Capturar possíveis exceções durante a execução
        try {

            // Excluir o registro do banco de dados
            $lesson->delete();

            // Salvar Log
            Log:: info('Aula apagada', ['Identificação' => $lesson->id]);

            // Redirecionar o usuário, enviar mensagem de sucesso
            return redirect()->route('lessons.index')->with('success', 'Aula excluída com sucesso!');
        } catch (Exception $e) {

            // Salvar Log
            Log:: notice('Aula não apagada', ['Erro' => $e->getMessage()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Aula não excluída!');
        }
    }
}
