    @extends('layouts.admin')
    @section('content')

        <h2>Perfil</h2>
        
        
        <a href="{{ route('profile.edit', ['user' => $user->id]) }}">Editar</a><br>
        <a href="{{ route('profile.edit_password', ['user' => $user->id]) }}">Editar Senha</a><br><br>

                {{-- Visualizar registro do usuário --}}
                <div style="margin-top: 15px;">
                    <ul style="list-style: none; padding:0; margin:0;">
                            <li style="margin-bottom: 5px;">
                                ID: {{ $user->id }}<br>
                                Nome: {{ $user->name}}<br>
                                Email: {{ $user->email }}<br>
                                Status do usuário: {{ $user->status->name }}<br><br>
                            </li>
                    </ul>
                </div>

        <!-- Modal e JS aqui -->
        <div id="successModal" class="modal" style="display:none;
            position: fixed; top:0; left:0; width:100%; height:100%;
            background: rgba(0,0,0,0.6); justify-content:center; align-items:center;">
            
            <div style="background:white; padding:25px; width:350px; border-radius:8px; text-align:center;">
                <h3 style="margin-bottom:10px; color:green;">Sucesso!</h3>
                <p>{{ session('success') }}</p>

                <button onclick="closeModal()" style="margin-top:15px; padding:8px 15px; cursor:pointer;">
                    Fechar
                </button>
            </div>
        </div>

        <script>
            function closeModal() {
                document.getElementById('successModal').style.display = 'none';
            }

            @if(session()->has('success'))
                document.addEventListener('DOMContentLoaded', function() {
                    document.getElementById('successModal').style.display = 'flex';
                });
            @endif
        </script>
        
                @if(session()->has('message'))
                    <x-alert />
                @endif
    @endsection