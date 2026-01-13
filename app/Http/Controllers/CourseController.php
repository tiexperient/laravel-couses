<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    // Listar os Cursos
    public function index()
    {
        // Recuperar os registros do banco de dados
        $courses = Course:: orderBy('id', 'DESC')->paginate(3);

        // Salvar Log
        Log:: info('Listagem de cursos', ['action_user_id' => Auth::id()]);

        // Carregar a view
        return view('courses.index', ['courses' => $courses]);
    }

    // Visualizar Curso
    public function show(Course $course)
    {
        // Salvar Log
        Log:: info('Visualização do curso', ['Identificação' => $course->id]);

        //dd($course);
        // Carregar a view
        return view('courses.show', ['course' => $course]);
    }

    // Adicionar os Cursos
    public function create()
    {
        // Carregar a view
        return view('courses.create');
    }

    // Adicionar os Cursos
    public function store(CourseRequest $request)
    {
        // Capturar as possíveis exceções durante a execução
        try {
        // Cadastrar no Banco de Dados
        $course = Course::create([
            'name' => $request->name
        ]);

        // Salvar Log
        Log:: info('Criação de curso', ['Identificação' => $course->id]);

        // Redirecionar o usuário, enviar mensagem de sucesso
        return redirect()->route('courses.show', ['course' => $course->id])->with('success', 'Curso cadastrado com sucesso!');
        } catch (Exception $e) {

            // Salvar Log
            Log:: notice('Curso não cadastrado', ['Erro' => $e->getMessage()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Curso não cadastrado!');
        }
    }

    // Carregar o formulário de editar curso
    public function edit(Course $course)
    {
        // Carregar a view
        return view('courses.edit', ['course' => $course]);
    }

    // Editar no banco de dados do curso
    public function update(CourseRequest $request, Course $course)
    {
        // Capturar as possíveis exceções durante a execução
        try {
        // Editar as informações do registro no banco de dados
        $course -> update([
            'name' => $request -> name
        ]);

        // Salvar Log
        Log:: info('Edição de curso', ['Identificação' => $course->id]);

        // Redirecionar o usuário, enviar mensagem de sucesso
        return redirect()->route('courses.show', ['course' => $course->id])->with('success', 'Curso atualizado com sucesso!');
        } catch (Exception $e) {

            // Salvar Log
            Log:: notice('Curso não editado', ['Erro' => $e->getMessage()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Curso não editado!');
        }
    }

    // Excluir o curso do banco de dados
    public function destroy(Course $course)
    {
        // Capturar possíveis exceções durante a execução
        try {

            // Excluir o registro do banco de dados
            $course->delete();

            // Salvar Log
            Log:: info('Curso apagado', ['Identificação' => $course->id]);

            // Redirecionar o usuário, enviar mensagem de sucesso
            return redirect()->route('courses.index')->with('success', 'Curso excluído com sucesso!');
        } catch (Exception $e) {

            // Salvar Log
            Log:: notice('Curso não apagado', ['Erro' => $e->getMessage()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Curso não excluído!');
        }
         
    }
}