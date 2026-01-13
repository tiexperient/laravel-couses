@extends('layouts.login')

@section('content')

        <h2>Cadastrar Usuário</h2>

        <form action="{{ route('register.store') }}" method="POST">
            @csrf
            @method('POST')

            <label>Nome de Usuário: </label>
            <input type="text" name="name" id="name" placeholder="Digite o nome completo" value="{{ old('name') }}" required>
            <br><br>
            <label>Email: </label>
            <input type="text" name="email" id="email" placeholder="Digite o seu melhor email" value="{{ old('email') }}" required>
            <br><br>
            <label>Senha: </label>
            <input type="password" name="password" id="password" placeholder="Senha com no mínimo 6 caracteres" value="{{ old('password') }}" required>
            <br><br>

            <label>Confirmar Senha: </label>
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirmar a senha" value="{{ old('password_confirmation') }}" required>
            <br><br>
            <button type="submit">Cadastrar</button><br><br>
        </form>

            <a href="{{ route('login') }}">Login</a><br><br>

            <x-alert />

@endsection