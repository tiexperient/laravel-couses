    <!-- TESTE_GIT_123 -->

    @extends('layouts.admin')
    @section('content')

        <h2>Listagem de usuários</h2>

        <a href="{{ route('users.create') }}">Criar um Usuário</a>

                {{-- Exibição de registros --}}
                <div style="margin-top: 15px;">
                    <ul style="list-style: none; padding:0; margin:0;">
                        @forelse ($users as $user)
                            <li style="margin-bottom: 5px;">
                                ID: {{ $user->id }}<br>
                                Nome do Usuário: {{ $user->name}}<br>
                                Email: {{ $user->email}}<br>
                                <a href="{{ route('users.show', ['user' => $user->id]) }}">Visualizar</a>
                                <a href="{{ route('users.edit', ['user' => $user->id]) }}">Editar</a>

                                <form action="{{ route('users.destroy', ['user' => $user->id]) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" onclick="return confirm('Tem certeza que deseja apagar este registro?')">Apagar</button>
                                </form>
                                
                                @if(session()->has('message'))
                                    <x-alert />
                                @endif
                            </li>
                            <hr>
                        @empty
                            <li>Nenhum usuário encontrado.</li>
                        @endforelse

                          <!-- Paginação Customizada -->
                          {{ $users->links('pagination::custom') }}
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
    @endsection