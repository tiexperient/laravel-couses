<   @extends('layouts.admin')

    @section('content')
        <h2>Cadastrar o Curso</h2>

        <a href="{{ route('courses.index') }}">Lista de Cursos</a><br><br>

        <form action="{{ route('courses.store') }}" method="POST">
            @csrf
            @method('POST')

            <label>Nome: </label>
            <input type="text" name="name" id="name" placeholder="Nome do Curso" value="{{ old('name') }}" >
            <br><br>
            <button type="submit">Cadastrar</button>
        </form>
                    <x-alert />
    @endsection
