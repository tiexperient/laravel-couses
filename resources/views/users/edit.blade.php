    @extends('layouts.admin')
    @section('content')
    
        <h2>Editar Usuário</h2>

        <a href="{{ route('users.index') }}">Lista de Usuários</a><br>
        <a href="{{ route('users.show', ['user' => $user->id]) }}">Visualizar</a><br><br>

        <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Nome de Usuário: </label>
            <input type="text" name="name" id="name" placeholder="Informe o nome do Usuário"  value="{{ old('name', $user->name)}}" >
            <br><br>
            <label>Email: </label>
            <input type="email" name="email" id="email" placeholder="Informe um email de Usuário" value="{{ old('email', $user->email)}}" >
            <br><br>
            <button type="submit">Salvar</button>
        </form>
        <x-alert />
    @endsection
