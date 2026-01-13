    @extends('layouts.admin')

    @section('content')
        <h2>Editar Status do Curso</h2>

        <a href="{{ route('status-course.index') }}">Lista de Status do Curso</a><br>
        <a href="{{ route('status-course.show', ['status' => $status->id]) }}">Visualizar</a><br><br>

        <form action="{{ route('status-course.update', ['status' => $status->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Status do Curso: </label>
            <input type="text" name="name" id="name" placeholder="Informe um Status para o Curso" value="{{ old('name', $status->name)}}" >
            <br><br>
            <button type="submit">Salvar</button>
        </form>
                    <x-alert />
    @endsection
