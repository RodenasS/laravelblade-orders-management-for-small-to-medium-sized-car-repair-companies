@if ($paginator->hasPages())
    <nav class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
        <ul class="pagination inline-flex items-center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled px-2 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li>
                    <a class="px-2 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active px-2 py-1 text-white transition-colors duration-150 bg-purple-600 border border-r-0 border-purple-600 rounded-md focus:outline-none focus:shadow-outline-purple" aria-current="page"><span>{{ $page }}</span></li>
                        @else
                            <li class="disabled mt-1 px-2 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple"><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a class="px-2 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple" href="{{ $paginator->nextPageUrl() }}" rel="next"
                       aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="disabled px-2 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
