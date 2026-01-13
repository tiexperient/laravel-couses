<   @extends('layouts.admin')

    @section('content')
        <h2>Cadastrar Aulas de Curso</h2>

        <a href="{{ route('lessons.index') }}">Lista de Aulas do Curso</a><br><br>

        <form action="{{ route('lessons.store') }}" method="POST">
            @csrf
            @method('POST')

            <label>Nome: </label>
            <input type="text" name="name" id="name" placeholder="Informe o título da Aula" value="{{ old('name') }}">
            <br><br>
            <button type="submit">Cadastrar</button>
        </form>
                    <x-alert />
    @endsection