    @extends('layouts.admin')

    @section('content')
        <h2>Editar Turma de Curso</h2>

        <a href="{{ route('batches.index', ['course' => $batches->course_id]) }}">Lista de Turmas</a><br>
        <a href="{{ route('batches.show', ['batches' => $batches->id]) }}">Visualizar</a><br><br>

        <form action="{{ route('batches.update', ['batches' => $batches->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Nome da Turma de Curso: </label>
            <input type="text" name="name" id="name" placeholder="Informe uma Turma para o Curso" value="{{ old('name', $batches->name)}}" >
            <br><br>
            <button type="submit">Salvar</button>
        </form>
                    <x-alert />
    @endsection
