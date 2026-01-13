    @extends('layouts.admin')

    @section('content')
        <h2>Listagem de turmas do curso</h2>

            <a href="{{ route('batches.create', ['course' => $course->id]) }}">Cadastrar Turma</a><br><br>

                {{-- Imprimir os registros --}}
                <div style="margin-top: 15px;">
                    <ul style="list-style: none; padding:0; margin:0;">
                        @forelse ($batches as $batch)



                            <li style="margin-bottom: 5px;">
                                ID: {{ $batch->id }}<br>
                                Turma: {{ $batch->name}}<br>
                                Curso: <a href="{{ route('courses.show', ['course' => $course->id]) }}">{{ $course->name }}</a><br><br>


                                <a href="{{ route('batches.show', ['batches' => $batch->id]) }}">Visualizar</a>
                                <a href="{{ route('batches.edit', ['batches' => $batch->id]) }}">Editar</a><br><br>

                                <form action="{{ route('batches.destroy', ['batches' => $batch->id]) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" onclick="return confirm('Tem certeza que deseja apagar este registro?')">Apagar</button>
                                </form>

                            </li>
                            <hr>
                        @empty
                            <li>Nenhuma turma encontrada.</li>
                        @endforelse

                          <!-- Paginação Customizada -->
                          {{ $batches->links('pagination::custom') }}
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