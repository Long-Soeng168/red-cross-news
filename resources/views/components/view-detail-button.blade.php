@props(['identifier', 'viewDetailUrl', 'tooltipText'])
<div class="pb-1">
    <!-- Modal toggle -->
    <a href="{{ $viewDetailUrl }}" data-tooltip-target="tooltip-view-detail-{{ $identifier }}" >
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye">
            <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
            <circle cx="12" cy="12" r="3" />
        </svg>
    </a>

    <!-- View tootip -->
    <div id="tooltip-view-detail-{{ $identifier }}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
        {{ $tooltipText }}
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
</div>
