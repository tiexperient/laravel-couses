    @extends('layouts.admin')

    @section('content')
        <h2>Cadastrar Status do Curso</h2>

        <a href="{{ route('status-course.index') }}">Lista de Status do Curso</a><br><br>

        <form action="{{ route('status-course.store') }}" method="POST">
            @csrf
            @method('POST')

            <label>Status do Curso: </label>
            <input type="text" name="name" id="name" placeholder="Informe um Status para o Curso" value="{{ old('name') }}" >
            <br><br>
            <button type="submit">Cadastrar</button>
        </form>
            <x-alert />
    @endsection
