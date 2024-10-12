@if ($paginator->hasPages())
    <ul class="shop-pagination box-shadow text-center ptblr-10-30">
        {{-- Nút "Previous" --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><span><i class="zmdi zmdi-chevron-left"></i></span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}"><i class="zmdi zmdi-chevron-left"></i></a></li>
        @endif

        {{-- Danh sách các trang --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li><span>{{ $element }}</span></li>
            @endif

            {{-- Mảng liên kết các số trang --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><a href="#">{{ $page }}</a></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Nút "Next" --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}"><i class="zmdi zmdi-chevron-right"></i></a></li>
        @else
            <li class="disabled"><span><i class="zmdi zmdi-chevron-right"></i></span></li>
        @endif
    </ul>
@endif