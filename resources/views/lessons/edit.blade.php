<   @extends('layouts.admin')

    @section('content')
        <h2>Editar Aulas de Curso</h2>

        <a href="{{ route('lessons.index') }}">Lista de Aulas do Curso</a><br>
        <a href="{{ route('lessons.show', ['lesson' => $lesson->id]) }}">Visualizar</a><br><br>

        <form action="{{ route('lessons.update', ['lesson' => $lesson->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Nome: </label>
            <input type="text" name="name" id="name" placeholder="Informe o título da Aula" value="{{ old('name', $lesson->name)}}" >
            <br><br>
            <button type="submit">Salvar</button>
        </form>
                    <x-alert />
    @endsection