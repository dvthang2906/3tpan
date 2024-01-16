@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
        <div class="flex-1 flex items-center justify-between">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="mr-1 px-4 py-2 text-gray-500 bg-white border border-gray-300 rounded-md cursor-not-allowed"
                    aria-disabled="true">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="mr-1 px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100"
                    rel="prev">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="mx-1 px-4 py-2 border border-gray-300 bg-white text-gray-700">{{ $element }}</span>
                @endif

                {{-- Array of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span
                                class="mx-1 px-4 py-2 text-white bg-blue-500 border border-blue-500 rounded-md">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}"
                                class="mx-1 px-4 py-2 text-gray-700 bg-whiteborder border-gray-300 rounded-md hover:bg-gray-100">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="ml-1 px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100"
                    rel="next">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="ml-1 px-4 py-2 text-gray-500 bg-white border border-gray-300 rounded-md cursor-not-allowed"
                    aria-disabled="true">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>
    </nav>
@endif
