@extends('layouts.admin')

@section('content')
    <h2>Editar Senha</h2>

    <a href="{{ route('profile.show') }}">Visualizar</a><br><br>

    <x-alert />

    <form action="{{ route('profile.update_password') }}" method="POST">
        @csrf
        @method('PUT')        

        <label>Senha: </label>
        <input type="password" name="password" id="password" placeholder="Digite a nova senha" value="{{ old('password') }}" ><br><br>

        <label>Confirmar Senha: </label>
        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirmar a senha"
            value="{{ old('password_confirmation') }}" ><br><br>

        <button type="submit">Salvar</button>
    </form>
@endsection
