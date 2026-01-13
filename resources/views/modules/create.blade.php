    @extends('layouts.admin')

    @section('content')
        <h2>Cadastrar Módulo de Curso</h2>



        <a href="{{ route('modules.index', ['batches' => $batches->id]) }}">
    Lista de Módulos do Curso
</a>


        <form action="{{ route('modules.store') }}" method="POST">
            @csrf
            @method('POST')

            <label>Módulo do Curso: </label>
            <input type="text" name="name" id="name" placeholder="Informe um Módulo para o Curso" value="{{ old('name') }}">
            <input type="hidden" name="course_batch_id" value="{{ $batches->id }}">

            <br><br>
            <button type="submit">Cadastrar</button>
        </form>
                    <x-alert />
    @endsection

