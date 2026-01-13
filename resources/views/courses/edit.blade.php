<   @extends('layouts.admin')

    @section('content')
        <h2>Editar o Curso</h2>

        <a href="{{ route('courses.index') }}">Lista de Cursos</a><br>
        <a href="{{ route('courses.show', ['course' => $course->id]) }}">Visualizar</a><br><br>

        <form action="{{ route('courses.update', ['course' => $course->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Nome: </label>
            <input type="text" name="name" id="name" placeholder="Nome do Curso" value="{{ old('name', $course->name)}}" >
            <br><br>
            <button type="submit">Salvar</button>
        </form>
                    <x-alert />
    @endsection