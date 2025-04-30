@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-turquoise-main border border-turquoise-dock cursor-default leading-5 rounded-md dark:text-white dark:bg-turquoise-main dark:border-turquoise-dock">
                Přechodzí hodnoty
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-turquoise-main border border-turquoise-dock leading-5 rounded-md hover:text-complementary focus:outline-none focus:ring ring-turquoise-main focus:border-turquoise-main active:bg-turquoise-dock active:text-white transition ease-in-out duration-150 dark:text-white dark:bg-turquoise-main dark:border-turquoise-dock dark:focus:border-complementary dark:active:bg-turquoise-dock dark:active:text-complementary">
                Přechodzí hodnoty
            </a>
        @endif
        
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-turquoise-main border border-turquoise-dock leading-5 rounded-md hover:text-complementary focus:outline-none focus:ring ring-turquoise-main focus:border-turquoise-main active:bg-turquoise-dock active:text-white transition ease-in-out duration-150 dark:text-white dark:bg-turquoise-main dark:border-turquoise-dock dark:focus:border-complementary dark:active:bg-turquoise-dock dark:active:text-complementary">
Další hodnoty            </a>
        @else
            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-turquoise-main border border-turquoise-dock cursor-default leading-5 rounded-md dark:text-white dark:bg-turquoise-main dark:border-turquoise-dock">
Další hodnoty            </span>
        @endif
    </nav>
@endif
