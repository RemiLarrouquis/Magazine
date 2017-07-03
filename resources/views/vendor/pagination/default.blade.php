@if ($paginator->hasPages())
    <nav class="text-xs-right">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            <li class="page-item">
                @if ($paginator->onFirstPage())
                    <span class="page-link" href=""> Prev </span>
                @else
                    <a class="page-link" href="#" onclick="pageToSurcharge('{{ $paginator->previousPageUrl() }}');"> Prev </a>
                @endif
            </li>

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item">
                        <a class="page-link" href=""> {{ $element }} </a>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                                <a class="page-link" href=""> {{ $page }} </a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="#" onclick="pageToSurcharge('{{ $url }}');"> {{ $page }} </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            <li class="page-item">
                @if ($paginator->hasMorePages())
                    <a class="page-link" href="#" onclick="pageToSurcharge('{{ $paginator->nextPageUrl() }}');"> Next </a>
                @else
                    <span class="page-link" href=""> Next </span>
                @endif
            </li>
        </ul>
    </nav>
@endif
