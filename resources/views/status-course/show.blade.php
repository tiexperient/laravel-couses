    @extends('layouts.admin')

    @section('content')

        <h2>Detalhes do Status do Curso</h2>
        <a href="{{ route('status-course.index') }}">Lista de Status dos Cursos</a><br>
        <a href="{{ route('status-course.edit', ['status' => $status->id]) }}">Editar</a><br><br>

                <form action="{{ route('status-course.destroy', ['status' => $status->id]) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" onclick="return confirm('Tem certeza que deseja apagar este registro?')">Apagar</button>
                </form>
        
                {{-- Imprimir o registro --}}
                <div style="margin-top: 15px;">
                    <ul style="list-style: none; padding:0; margin:0;">
                            <li style="margin-bottom: 5px;">
                                ID: {{ $status->id }}<br>
                                Status: {{ $status->name}}<br><br>
                                Cadastrado em: {{ \Carbon\Carbon::parse($status->created_at)->format('d/m/Y H:i:s')}}<br>
                                Editado: {{ \Carbon\Carbon::parse($status->updated_at)->format('d/m/Y H:i:s')}}<br>
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


        <!-- Modal de Erro -->
        <div id="errorModal" class="modal" style="display:none;
            position: fixed; top:0; left:0; width:100%; height:100%;
            background: rgba(0,0,0,0.6); justify-content:center; align-items:center;">

            <div style="background:white; padding:25px; width:350px; border-radius:8px; text-align:center;">
                <h3 style="margin-bottom:10px; color:#c62828;">Erro!</h3>
                <p>{{ session('error') }}</p>

                <button onclick="closeErrorModal()" style="margin-top:15px; padding:8px 15px; cursor:pointer; background:#c62828; color:white; border:none; border-radius:5px;">
                    Fechar
                </button>
            </div>
        </div>

        <script>
            function closeErrorModal() {
                document.getElementById('errorModal').style.display = 'none';
            }

            @if(session()->has('error'))
                document.addEventListener('DOMContentLoaded', function() {
                    document.getElementById('errorModal').style.display = 'flex';
                });
            @endif
        </script>
                
    @endsection