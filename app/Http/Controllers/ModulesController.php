<?php

namespace App\Http\Controllers;

use App\Http\Requests\ModuleRequest;
use App\Models\CourseBatch;
use App\Models\Module;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ModulesController extends Controller
{
    // Listar os Módulos dos Cursos
    public function index(CourseBatch $batches)
    {
        // Recuperar os registros do banco de dados
        $module = Module:: orderBy('id', 'DESC')
        ->where('course_batch_id', $batches->id)
        ->paginate(3);

        // Salvar Log
        Log:: info('Listagem de módulos', ['action_user_id' => Auth::id()]);

        // Carregar a view
        return view('modules.index', [
            'module' => $module,
            'batches' => $batches   // ⭐ ESTA LINHA FALTAVA
]);

    }

    // Visualizar Módulo do Curso
    public function show(Module $module)
    {
        // Salvar Log
        Log:: info('Visualização do módulo', ['Identificação' => $module->id]);

        // Carregar a view
        return view('modules.show', ['module' => $module]);
    }

    // Adicionar os Módulos dos Cursos
    public function create(CourseBatch $batches)
    {
        // Carregar a view
        return view('modules.create', [
        'batches' => $batches
    ]);
    }

    // Adicionar os Módulos dos Cursos
    public function store(ModuleRequest $request)
    {
        // Capturar as possíveis exceções durante a execução
        try {
        // Cadastrar no Banco de Dados
        $module = Module::create([
            'name' => $request->name,
            'course_batch_id' => $request->course_batch_id,
        ]);

        // Salvar Log
        Log:: info('Criação de módulo', ['Identificação' => $module->id]);

        //Redirecionar o usuário, enviar a mensagem de sucesso
        return redirect()->route('modules.show', ['module' => $module->id])->with('success', 'Módulo cadastrado com sucesso!');
        } catch (Exception $e) {

            // Salvar Log
            Log:: notice('Módulo não cadastrado', ['Erro' => $e->getMessage()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Módulo não cadastrado!');
        }
    }

    // Carregar o formulário de editar módulos dos cursos
    public function edit(Module $module)
    {
        // Carregar a view
        return view('modules.edit', ['module' => $module]);
    }

    // Editar no banco de dados de Módulos
    public function update(ModuleRequest $request, Module $module)
    {
        // Capturar as possíveis exceções durante a execução
        try {
        // Editar as informações do registro no banco de dados
        $module -> update([
            'name' => $request -> name
        ]);

        // Salvar Log
        Log:: info('Edição de módulo', ['Identificação' => $module->id]);

        // Redirecionar o usuário, enviar mensagem de sucesso
        return redirect()->route('modules.show', ['module' => $module->id])->with('success', 'Módulo atualizado com sucesso!');
        } catch (Exception $e) {

            // Salvar Log
            Log:: notice('Módulo não editado', ['Erro' => $e->getMessage()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Módulo não editado!');
        }
    }

    // Excluir módulo do banco de dados
    public function destroy(Module $module)
    {
        // Capturar possíveis exceções durante a execução
        try {

            // Excluir o registro do banco de dados
            $module->delete();

            // Salvar Log
            Log:: info('Módulo apagado', ['Identificação' => $module->id]);

            // Redirecionar o usuário, enviar mensagem de sucesso
            return redirect()->route('modules.index')->with('success', 'Módulo excluído com sucesso!');
        } catch (Exception $e) {

            // Salvar Log
            Log:: notice('Módulo não apagado', ['Erro' => $e->getMessage()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Módulo não excluído!');
        }
    }
}
