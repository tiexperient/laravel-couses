    @extends('layouts.admin')

    @section('content')
        <h2>Listagem de módulos de cursos</h2>

        @if(session()->has('message'))
            <x-alert />
        @endif


        <a href="{{ route('modules.create', ['batches' => $batches->id]) }}">
    Criar Módulo
</a>


                {{-- Imprimir os registros --}}
                <div style="margin-top: 15px;">
                    <ul style="list-style: none; padding:0; margin:0;">
                        @forelse ($module as $modules)

                            <a href="{{ route('lessons.index', ['modules' => $modules->id]) }}">🎥 Listar Aulas desse Módulo</a><br><br>

                            <li style="margin-bottom: 5px;">
                                ID: {{ $modules->id }}<br>
                                Módulo do Curso: {{ $modules->name}}<br>
                                
                                <a href="{{ route('modules.show', ['module' => $modules->id]) }}">Visualizar</a>
                                <a href="{{ route('modules.edit', ['module' => $modules->id]) }}">Editar</a><br><br>

                                <form action="{{ route('modules.destroy', ['module' => $modules->id]) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" onclick="return confirm('Tem certeza que deseja apagar este registro?')">Apagar</button>
                                </form>
                            </li>
                            <hr>
                        @empty
                            <li>Nenhum módulo de curso encontrado.</li>
                        @endforelse
                          <!-- Paginação Customizada -->
                          {{ $module->links('pagination::custom') }}
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