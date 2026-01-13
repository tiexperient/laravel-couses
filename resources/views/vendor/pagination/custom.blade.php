@if ($paginator->hasPages())
    <nav style="margin-top: 15px;">

        {{-- LINKS PRINCIPAIS --}}
        <ul class="pagination" style="display:flex; gap:8px; list-style:none; padding-left:0; margin-bottom:8px;">

            {{-- Link Anterior --}}
            @if ($paginator->onFirstPage())
                <li style="opacity:0.5;">« Anterior</li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}" style="text-decoration:none;">« Anterior</a></li>
            @endif

            {{-- Números das páginas --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li style="opacity:0.5;">{{ $element }}</li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li style="font-weight:bold; text-decoration:underline;">{{ $page }}</li>
                        @else
                            <li><a href="{{ $url }}" style="text-decoration:none;">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Link Próximo --}}
            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}" style="text-decoration:none;">Próximo »</a></li>
            @else
                <li style="opacity:0.5;">Próximo »</li>
            @endif

        </ul>

        {{-- TEXTO INFORMATIVO --}}
        <div style="font-size:14px; color:#555;">
            Mostrando 
            <strong>{{ $paginator->firstItem() }}</strong>
            até 
            <strong>{{ $paginator->lastItem() }}</strong>
            de 
            <strong>{{ $paginator->total() }}</strong>
            resultados
        </div>

    </nav>
@endif
