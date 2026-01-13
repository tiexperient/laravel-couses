    @extends('layouts.admin')
    @section('content')

        <h2>Listar Status de Usuários</h2>

        <a href="{{ route('status-user.create') }}">Criar um Status de Usuário</a>

                {{-- Imprimir os registros --}}
                <div style="margin-top: 15px;">
                    <ul style="list-style: none; padding:0; margin:0;">
                        @forelse ($status_user as $status_users)
                            <li style="margin-bottom: 5px;">
                                ID: {{ $status_users->id }}<br>
                                Status doe Usuário: {{ $status_users->name}}<br>
                                <a href="{{ route('status-user.show', ['status_user' => $status_users->id]) }}">Visualizar</a>
                                <a href="{{ route('status-user.edit', ['status_user' => $status_users->id]) }}">Editar</a>

                                <form action="{{ route('status-user.destroy', ['status_user' => $status_users->id]) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" onclick="return confirm('Tem certeza que deseja apagar este registro?')">Apagar</button>
                                </form>
                            </li>
                            <hr>
                        @empty
                            <li>Nenhum status de usuário encontrado.</li>
                        @endforelse
                          <!-- Paginação Customizada -->
                          {{ $status_user->links('pagination::custom') }}
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