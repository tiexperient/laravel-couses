    @extends('layouts.admin')
    @section('content')
    
        <h2>Editar Senha</h2>

        <a href="{{ route('users.index') }}">Lista de Usuários</a><br>
        <a href="{{ route('users.show', ['user' => $user->id]) }}">Visualizar</a><br><br>

        <form action="{{ route('users.update_password', ['user' => $user->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Senha: </label>
            <input type="password" name="password" id="password" placeholder="Informe uma senha de Usuário" value="{{ old('password') }}" required>
            <br><br>

            <label>Confirmar Senha: </label>
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirmar a senha" value="{{ old('password_confirmation') }}">
            <br><br>
            <button type="submit">Salvar</button>
        </form>
            <x-alert />
    @endsection
