{{-- ERROS DE VALIDAÇÃO --}}
@if ($errors->any())
    <div style="color: rgb(198, 4, 4)">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

{{-- MENSAGEM DE SUCESSO --}}
@if (session('success'))
    <p style="color: #082">
        {{ session('success') }}
    </p>
@endif

{{-- MENSAGEM DE ERRO MANUAL --}}
@if (session('error'))
    <p style="color: rgb(198, 4, 4)">
        {{ session('error') }}
    </p>
@endif
