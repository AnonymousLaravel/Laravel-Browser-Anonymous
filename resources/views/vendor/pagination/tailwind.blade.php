@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}"
        class="flex items-center justify-between p-4 bg-gray-50 border-t border-gray-200 dark:bg-gray-800 dark:border-gray-700 rounded-lg shadow-md">

        <!-- Mobile Pagination Controls -->
        <div class="flex justify-between flex-1 sm:hidden gap-3">
            @if ($paginator->onFirstPage())
                <span
                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-not-allowed rounded-md dark:text-gray-600 dark:bg-gray-800 dark:border-gray-600">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:ring-blue-600 dark:focus:border-blue-500">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:ring-blue-600 dark:focus:border-blue-500">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span
                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-not-allowed rounded-md dark:text-gray-600 dark:bg-gray-800 dark:border-gray-600">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>

        <!-- Desktop Pagination Controls -->
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between gap-6">
            <div>
                <p class="text-sm text-gray-700 dark:text-gray-400">
                    {!! __('Mostrando dal ') !!}
                    @if ($paginator->firstItem())
                        <span class="font-semibold">{{ $paginator->firstItem() }}</span>
                        {!! __('al') !!}
                        <span class="font-semibold">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    {!! __('dei') !!}
                    <span class="font-semibold">{{ $paginator->total() }}</span>
                    {!! __('risultati') !!}
                </p>
            </div>

            <div class="relative z-0 inline-flex shadow-sm rounded-md gap-x-2">
                {{-- Dynamic page number calculation --}}
                @php
                    $start = max(1, $paginator->currentPage() - 4);
                    $end = min($start + 9, $paginator->lastPage());
                @endphp

                {{-- Page numbers --}}
                @foreach (range($start, $end) as $page)
                    @if ($page == $paginator->currentPage())
                        <span aria-current="page">
                            <span
                                class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-blue-600 rounded-md">
                                {{ $page }}
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->url($page) }}"
                            class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:text-gray-600 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:hover:text-gray-200 dark:active:bg-gray-700 dark:focus:border-blue-800">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                        class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:text-gray-600 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:hover:text-gray-200 dark:active:bg-gray-700 dark:focus:border-blue-800">
                        {!! __('pagination.next') !!}
                    </a>
                @else
                    <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                        <span
                            class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-not-allowed rounded-md dark:text-gray-400 dark:bg-gray-800 dark:border-gray-600">
                            {!! __('pagination.next') !!}
                        </span>
                    </span>
                @endif
            </div>
        </div>
    </nav>
@endif