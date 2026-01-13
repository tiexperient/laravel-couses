    @extends('layouts.admin')
    @section('content')
    
        <h2>Editar Status de Usuário</h2>

        <a href="{{ route('status-user.index') }}">Lista de Status de Usuários</a><br>
        <a href="{{ route('status-user.show', ['status_user' => $status_user->id]) }}">Visualizar</a><br><br>

        <form action="{{ route('status-user.update', ['status_user' => $status_user->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Status de Usuário: </label>
            <input type="text" name="name" id="name" placeholder="Informe um Status de Usuário" value="{{ old('name', $status_user->name)}}" >
            <br><br>
            <button type="submit">Salvar</button>
        </form>
        <x-alert />
    @endsection
