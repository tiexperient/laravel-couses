    @extends('layouts.admin')

    @section('content')
        <h2>Editar Módulo de Curso</h2>

        <a href="{{ route('modules.index') }}">Lista de Módulos do Curso</a><br>
        <a href="{{ route('modules.show', ['module' => $module->id]) }}">Visualizar</a><br><br>

        <form action="{{ route('modules.update', ['module' => $module->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Módulo do Curso: </label>
            <input type="text" name="name" id="name" placeholder="Informe um Módulo para o Curso" value="{{ old('name', $module->name)}}" >
            <br><br>
            <button type="submit">Salvar</button>
        </form>
                    <x-alert />
    @endsection