    @extends('layouts.admin')

    @section('content')
        <h2>Detalhes da Turma</h2>

        <a href="{{ route('batches.index', ['course' => $batches->course_id]) }}">Lista de Turmas</a><br>
        <a href="{{ route('modules.index' , ['batches' => $batches->id]) }}">📚 Listar Módulos dessa Turma</a><br><br>
        <a href="{{ route('batches.edit', ['batches' => $batches->id]) }}">Editar</a><br><br>

            <form action="{{ route('batches.destroy', ['batches' => $batches->id]) }}" method="POST">
                @csrf
                @method('delete')
                <button type="submit" onclick="return confirm('Tem certeza que deseja apagar este registro?')">Apagar</button>
            </form>
        
                {{-- Imprimir o registro --}}
                <div style="margin-top: 15px;">
                    <ul style="list-style: none; padding:0; margin:0;">
                            <li style="margin-bottom: 5px;">
                                ID: {{ $batches->id }}<br>
                                Nome da Turma: {{ $batches->name}}<br>
                                Curso: {{ $batches->course->name}}<br><br>
                                Cadastrado em: {{ \Carbon\Carbon::parse($batches->created_at)->format('d/m/Y H:i:s')}}<br>
                                Editado: {{ \Carbon\Carbon::parse($batches->updated_at)->format('d/m/Y H:i:s')}}<br>
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
    @endsection