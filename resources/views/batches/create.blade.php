    @extends('layouts.admin')

    @section('content')
        <h2>Cadastrar Turma de Curso</h2>

        <a href="{{ route('batches.index', ['course' => $course->id]) }}">Lista de Turmas</a><br><br>

        <form action="{{ route('batches.store', ['course' => $course->id]) }}" method="POST">
            @csrf
            @method('POST')

            <label>Nome da Turma de Curso: </label>
            <input type="text" name="name" id="name" placeholder="Informe uma Turma para o Curso" value="{{ old('name') }}" >
            <input type="hidden" name="course_id" value="{{ $course->id }}">

            <br><br>
            <button type="submit">Cadastrar</button>
        </form>
                    <x-alert />
    @endsection
