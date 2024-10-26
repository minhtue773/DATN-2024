@if ($paginator->hasPages())
    <ul class="pagination justify-content-center">
        {{-- Previous Button --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}&category_id={{ request('category_id') }}&sort_by={{ request('sort_by') }}" aria-label="Previous">
                    &laquo;
                </a>
            </li>
        @endif

        {{-- Page Numbers --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item"><span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Array of Page Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active"><a class="page-link" href="#">{{ $page }}</a></li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}&category_id={{ request('category_id') }}&sort_by={{ request('sort_by') }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Button --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}&category_id={{ request('category_id') }}&sort_by={{ request('sort_by') }}" aria-label="Next">
                    &raquo;
                </a>
            </li>
        @else
            <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
        @endif
    </ul>
@endif