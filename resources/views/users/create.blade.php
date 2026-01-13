    @extends('layouts.admin')
    @section('content')
    
        <h2>Cadastrar Usuário</h2>

        <a href="{{ route('users.index') }}">Lista de Usuários</a><br><br>

        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            @method('POST')

            <label>Nome de Usuário: </label>
            <input type="text" name="name" id="name" placeholder="Informe o nome do Usuário" value="{{ old('name') }}" >
            <br><br>
            <label>Email: </label>
            <input type="text" name="email" id="email" placeholder="Informe um email de Usuário" value="{{ old('email') }}" >
            <br><br>
            <label>Senha: </label>
            <input type="password" name="password" id="password" placeholder="Informe uma senha de Usuário" value="{{ old('password') }}" >
            <br><br>

            <label>Confirmar Senha: </label>
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirmar a senha" value="{{ old('password_confirmation') }}">
            <br><br>
            
            <button type="submit">Cadastrar</button>
        </form>
                <x-alert />
    @endsection
