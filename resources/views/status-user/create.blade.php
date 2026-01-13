    @extends('layouts.admin')

    @section('content')
        <h2>Cadastrar Status de Usuário</h2>

        <a href="{{ route('status-user.index') }}">Lista de Status de Usuários</a><br><br>

        <form action="{{ route('status-user.store') }}" method="POST">
            @csrf
            @method('POST')

            <label>Status de Usuário: </label>
            <input type="text" name="name" id="name" placeholder="Informe um Status de Usuário" value="{{ old('name') }}">
            <br><br>
            <button type="submit">Cadastrar</button>
        </form>
                    <x-alert />
    @endsection
