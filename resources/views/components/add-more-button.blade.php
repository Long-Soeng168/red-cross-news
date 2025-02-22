@props(['identifier', 'addMoreUrl', 'tooltipText'])

<div class="flex items-center justify-center">
    <!-- Modal toggle -->
    <a href="{{ $addMoreUrl }}" data-tooltip-target="tooltip-add-more-{{ $identifier }}" >
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-circle">
            <circle cx="12" cy="12" r="10" />
            <path d="M8 12h8" />
            <path d="M12 8v8" />
        </svg>
    </a>

    <!-- View tootip -->
    <div id="tooltip-add-more-{{ $identifier }}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
        {{ $tooltipText }}
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
</div>
