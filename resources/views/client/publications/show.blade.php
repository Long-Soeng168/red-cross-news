@extends('layouts.client')

@section('content')
    {{-- Start Search --}}
    @include('client.components.search', [
        'actionUrl' => url('/publications'),
        'title' => 'E-Publications',
        'title_kh' => 'ឯកសារអេឡិចត្រូនិច',
    ])
    {{-- End Search --}}

    <!-- Detail -->
    <div class="max-w-screen-xl px-2 mx-auto mt-6 lg:px-0">
        @php
            if ($websiteInfo->check_ip_range) {
                $userIp = request()->ip();
                // $ipRanges = ['203.144.68.205/32', '27.109.114.162', '127.0.0.1'];
                $ipRanges = explode(',', $websiteInfo->ip_range);

                function ip_in_range($ip, $range)
                {
                    if (strpos($range, '/') === false) {
                        $range .= '/32'; // Append /32 if no subnet is provided
                    }

                    [$range, $netmask] = explode('/', $range, 2);
                    $range_dec = ip2long($range);
                    $ip_dec = ip2long($ip);
                    $wildcard_dec = pow(2, 32 - $netmask) - 1;
                    $netmask_dec = ~$wildcard_dec;

                    return ($ip_dec & $netmask_dec) === ($range_dec & $netmask_dec);
                }

                $ipInRange = false; // Initialize the flag

                foreach ($ipRanges as $range) {
                    if (ip_in_range($userIp, $range)) {
                        $ipInRange = true; // Set flag to true if match is found
                        break;
                    }
                }
            } else {
                $ipInRange = true;
            }

        @endphp

        <div class="min-[800px]:grid grid-cols-12 gap-4">
            <div class="flex flex-col items-center w-full col-span-5 px-2 mb-6 mr-2 lg:col-span-4 lg-px-0">
                <div class="flex flex-col w-full gap-2">
                    @if ($item->image)
                        <a href="{{ asset('assets/images/publications/' . $item->image) }}" class="glightbox">
                            <img class="w-full bg-white border rounded-md shadow cursor-pointer"
                                src="{{ asset('assets/images/publications/thumb/' . $item->image) }}" alt="Book Cover" />
                        </a>
                    @else
                        <div class="aspect-{{ env('EPUB_ASPECT') }} border rounded-md shadow cursor-pointer relative">
                            <img class="object-contain w-full h-full" src="{{ asset('assets/book_cover_default.png') }}"
                                alt="Book Cover" />

                            <h1
                                class="absolute block w-full p-4 text-2xl font-medium font-bold leading-9 text-center text-gray-700 transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 dark:text-gray-100">
                                @if (app()->getLocale() == 'kh' && $item->name_kh)
                                    {{ $item->name_kh }}
                                @else
                                    {{ $item->name }}
                                @endif
                            </h1>

                        </div>
                    @endif
                    <div class="grid grid-cols-4 gap-2">
                        @foreach ($multi_images as $index => $image)
                            @if ($index < 3 || count($multi_images) == 4)
                                <a href="{{ asset('assets/images/publications/thumb/' . $image->image) }}"
                                    class="glightbox">
                                    <img class="bg-white w-full aspect-[1/1] hover:scale-110 transition-transform duration-500 ease-in-out object-cover rounded-md border shadow-md"
                                        src="{{ asset('assets/images/publications/thumb/' . $image->image) }}">
                                </a>
                            @elseif ($index == 3)
                                <a href="{{ asset('assets/images/publications/' . $image->image) }}"
                                    class="glightbox relative w-full aspect-[1/1] hover:scale-110 transition-transform duration-500 ease-in-out ">
                                    <div
                                        class="absolute flex items-center justify-center w-full h-full transition-all duration-300 border rounded-md shadow-md bg-gray-900/60 hover:bg-gray-900/20">
                                        <span class="text-xl font-medium text-white">
                                            +{{ count($multi_images) - 4 }}
                                        </span>
                                    </div>
                                    <img src="{{ asset('assets/images/publications/thumb/' . $image->image) }}"
                                        class="bg-white rounded-lg w-full aspect-[1/1]">
                                </a>
                            @else
                                <a href="{{ asset('assets/images/publications/' . $image->image) }}" class="glightbox">
                                    <img class="bg-white hidden w-full aspect-[1/1] hover:scale-110 transition-transform duration-500 ease-in-out object-cover rounded-md border shadow-md"
                                        src="{{ asset('assets/images/publications/thumb/' . $image->image) }}">
                                </a>
                            @endif
                        @endforeach
                    </div>
                    <!-- Action Button -->
                    <div class="flex w-full gap-2 rounded-md shadow-sm" role="group">
                        @if ($ipInRange)
                            <div class="flex-1">
                                {{-- Start Read Button --}}
                                <a @if (!$item->can_read && !auth()->check()) href="{{ route('client.login', ['path' => 'publications-' . $item->id]) }}"
                                @else
                                    @if (!$item->pdf && $item->link)
                                        href="{{ $item->link }}"
                                    @elseif($websiteInfo->pdf_viewer_default == 1)
                                        href="{{ route('pdf.stream', [
                                            'archive' => 'publication',
                                            'id' => $item->id,
                                            'file_name' => $item->pdf ?? ' ',
                                        ]) }}"
                                    @else
                                        href="{{ route('pdf.view', [
                                            'archive' => 'publication',
                                            'id' => $item->id,
                                            'file_name' => $item->pdf ?? ' ',
                                        ]) }}" @endif
                                    @endif

                                    class="relative inline-flex items-center justify-center w-full h-full gap-2 px-4 py-2 text-sm font-medium text-gray-900 bg-transparent border border-gray-900 rounded-md hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700"
                                    >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye">
                                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg>
                                    <div>
                                        <div class="flex flex-wrap gap-1">
                                            <p class="whitespace-nowrap">{{ __('messages.readPdf') }}</p>
                                            @if ($item->read_count)
                                                <p>( {{ $item->read_count }} )</p>
                                            @endif
                                        </div>
                                    </div>
                                    @if (!$item->can_read)
                                        <span class="absolute bg-red-500 border rounded-full -top-1.5 -right-1.5">
                                            <img class="w-6 h-6 " src="{{ asset('assets/icons/lock.png') }}"
                                                alt="">
                                        </span>
                                    @endif

                                </a>
                                {{-- End Read Button --}}

                                {{-- <button type="button"
                                class="inline-flex items-center justify-center w-full gap-2 px-4 py-1 text-sm font-medium text-gray-900 bg-transparent border border-gray-900 rounded-md hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700"
                                onclick="openPdfPopup('{{ asset('assets/pdf/publications/' . $item->pdf) }}', 'publication', {{ $item->id }})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-eye">
                                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                                <div>
                                    <div class="flex flex-wrap gap-1">
                                        <p class="whitespace-nowrap">{{ __('messages.readPdf') }}</p>
                                        @if ($item->read_count)
                                        <p>( {{ $item->read_count }} )</p>
                                        @endif
                                    </div>
                                </div>
                            </button> --}}

                            </div>

                            <!-- Popup Container -->
                            <div class="popup-overlay" id="popupOverlay">
                                <div class="popup-content-container">
                                    <div class="popup-content">
                                        <span class="close-btn" onclick="closePdfPopup()">
                                            <img src="{{ asset('assets/icons/cancel.png') }}" alt=""
                                                class="close-btn-image" />
                                        </span>
                                        <embed id="pdfEmbed" src="" width="100%" height="100%" />
                                    </div>
                                </div>
                            </div>

                            @if ($websiteInfo->show_download_button)
                                <div class="flex-1">
                                    {{-- Start Download Button --}}
                                    <a @if (!$item->can_download && !auth()->check()) href="{{ route('client.login', ['path' => 'publications-' . $item->id]) }}"
                                @else
                                href="{{ route('pdf.download', [
                                    'archive' => 'publication',
                                    'id' => $item->id,
                                    'file_name' => $item->pdf ?? ' ',
                                ]) }}"
                                onclick="
                                    (function(){
                                        fetch(`/add_download_count/publication/{{ $item->id }}`)
                                        .then(response => {
                                            if (response.ok) {
                                                console.log('success');
                                            } else {
                                                console.error('Error:', response.statusText);
                                            }
                                        })
                                        .catch(error => {
                                            console.error('Error:', error);
                                        });
                                    })();
                                " @endif
                                        class="relative inline-flex items-center justify-center w-full h-full gap-2 px-2 py-2 text-sm font-medium text-gray-900 bg-transparent border border-gray-900 rounded-md hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-arrow-down-to-line">
                                            <path d="M12 17V3" />
                                            <path d="m6 11 6 6 6-6" />
                                            <path d="M19 21H5" />
                                        </svg>
                                        <div class="flex flex-wrap gap-1">
                                            <p class="whitespace-nowrap">{{ __('messages.download') }}</p>
                                            @if ($item->download_count)
                                                <p>( {{ $item->download_count }} )</p>
                                            @endif
                                        </div>
                                        @if (!$item->can_download)
                                            <span class="absolute bg-red-500 border rounded-full -top-1.5 -right-1.5">
                                                <img class="w-6 h-6 " src="{{ asset('assets/icons/lock.png') }}"
                                                    alt="">
                                            </span>
                                        @endif
                                    </a>
                                    {{-- End Download Button --}}

                                </div>
                            @endif

                        @endif



                    </div>
                </div>
            </div>
            <div class="col-span-7 lg:col-span-8">
                <div class="text-sm font-semibold tracking-wide uppercase text-primary">
                    {{ __('messages.ePublication') }}
                </div>
                <h1 class="block mt-1 mb-2 text-2xl font-medium leading-tight text-gray-800 dark:text-gray-100">
                    @if (app()->getLocale() == 'kh' && $item->name_kh)
                        {{ $item->name_kh }}
                    @else
                        {{ $item->name }}
                    @endif

                </h1>
                <div class="flex flex-col gap-2">
                    @if ($item->author?->name || $item->author_name)
                        <div class="flex nowrap">
                            <p
                                class="w-[123px] uppercase tracking-wide text-sm text-gray-500 dark:text-gray-300 font-semibold border-r border-gray-600 dark:border-gray-300 pr-5 mr-5 flex-shrink-0">
                                {{ __('messages.author') }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-200">
                                @if ($item->author?->name)
                                    {{ $item->author?->name }}
                                @elseif($item->author_name)
                                    {{ $item->author_name }}
                                @endif
                            </p>
                        </div>
                    @endif

                    @if ($item->edition)
                        <div class="flex nowrap">
                            <p
                                class="w-[123px] uppercase tracking-wide text-sm text-gray-500 dark:text-gray-300 font-semibold border-r border-gray-600 dark:border-gray-300 pr-5 mr-5 flex-shrink-0">
                                {{ __('messages.edition') }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-200">
                                {{ $item->edition }}
                            </p>
                        </div>
                    @endif

                    @if ($item->year)
                        <div class="flex nowrap">
                            <p
                                class="w-[123px] uppercase tracking-wide text-sm text-gray-500 dark:text-gray-300 font-semibold border-r border-gray-600 dark:border-gray-300 pr-5 mr-5 flex-shrink-0">
                                {{ __('messages.year') }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-200">
                                {{ $item->year }}
                            </p>
                        </div>
                    @endif

                    @if ($item->publisher?->name || $item->publisher_name)
                        <div class="flex nowrap">
                            <p
                                class="w-[123px] uppercase tracking-wide text-sm text-gray-500 dark:text-gray-300 font-semibold border-r border-gray-600 dark:border-gray-300 pr-5 mr-5 flex-shrink-0">
                                {{ __('messages.publisher') }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-200">
                                @if ($item->publisher?->name)
                                    {{ $item->publisher?->name }}
                                @elseif($item->publisher_name)
                                    {{ $item->publisher_name }}
                                @endif
                            </p>
                        </div>
                    @endif

                    @if ($item->publicationType?->name)
                        <div class="flex nowrap">
                            <p
                                class="w-[123px] uppercase tracking-wide text-sm text-gray-500 dark:text-gray-300 font-semibold border-r border-gray-600 dark:border-gray-300 pr-5 mr-5 flex-shrink-0">
                                {{ __('messages.type') }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-200">
                                {{ app()->getLocale() == 'kh' ? $item->publicationType?->name_kh : $item->publicationType?->name }}
                            </p>
                        </div>
                    @endif

                    @if ($item->publicationCategory?->name)
                        <div class="flex nowrap">
                            <p
                                class="w-[123px] uppercase tracking-wide text-sm text-gray-500 dark:text-gray-300 font-semibold border-r border-gray-600 dark:border-gray-300 pr-5 mr-5 flex-shrink-0">
                                {{ __('messages.category') }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-200">
                                @if (app()->getLocale() == 'kh' && $item->publicationCategory?->name_kh)
                                    {{ $item->publicationCategory?->name_kh }}
                                @else
                                    {{ $item->publicationCategory?->name }}
                                @endif

                                @if (app()->getLocale() == 'kh' && $item->publicationSubCategory?->name_kh)
                                    / {{ $item->publicationSubCategory?->name_kh }}
                                @elseif($item->publicationSubCategory?->name)
                                    / {{ $item->publicationSubCategory?->name }}
                                @endif

                            </p>
                        </div>
                    @endif

                    @if ($item->language?->name || $item->language_name)
                        <div class="flex nowrap">
                            <p
                                class="w-[123px] uppercase tracking-wide text-sm text-gray-500 dark:text-gray-300 font-semibold border-r border-gray-600 dark:border-gray-300 pr-5 mr-5 flex-shrink-0">
                                {{ __('messages.language') }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-200">
                                @if ($item->language?->name)
                                    {{ app()->getLocale() == 'kh' ? $item->language?->name_kh : $item->language?->name }}
                                @elseif($item->language_name)
                                    {{ $item->language_name }}
                                @endif
                            </p>
                        </div>
                    @endif

                    @if ($item->pages_count)
                        <div class="flex nowrap">
                            <p
                                class="w-[123px] uppercase tracking-wide text-sm text-gray-500 dark:text-gray-300 font-semibold border-r border-gray-600 dark:border-gray-300 pr-5 mr-5 flex-shrink-0">
                                {{ __('messages.pages') }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-200">
                                {{ $item->pages_count }}
                            </p>
                        </div>
                    @endif

                    @if ($item->isbn)
                        <div class="flex nowrap">
                            <p
                                class="w-[123px] uppercase tracking-wide text-sm text-gray-500 dark:text-gray-300 font-semibold border-r border-gray-600 dark:border-gray-300 pr-5 mr-5 flex-shrink-0">
                                {{ __('messages.isbn') }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-200">
                                {{ $item->isbn }}
                            </p>
                        </div>
                    @endif

                    @if ($item->location?->name)
                        <div class="flex nowrap">
                            <p
                                class="w-[123px] uppercase tracking-wide text-sm text-gray-500 dark:text-gray-300 font-semibold border-r border-gray-600 dark:border-gray-300 pr-5 mr-5 flex-shrink-0">
                                {{ __('messages.location') }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-200">
                                {{ $item->location?->name }}
                            </p>
                        </div>
                    @endif

                    @if ($item->link)
                        <div class="flex nowrap">
                            <p
                                class="w-[123px] uppercase tracking-wide text-sm text-gray-500 dark:text-gray-300 font-semibold border-r border-gray-600 dark:border-gray-300 pr-5 mr-5 flex-shrink-0">
                                {{ __('messages.link') }}
                            </p>
                            <p
                                class="text-sm text-gray-600 dark:text-gray-200 hover:text-blue-500 dark:hover:text-blue-400">
                                <a href="{{ $item->link }}" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-square-arrow-out-up-right">
                                        <path d="M21 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h6" />
                                        <path d="m21 3-9 9" />
                                        <path d="M15 3h6v6" />
                                    </svg>
                                </a>
                            </p>
                        </div>
                    @endif
                    {{-- @if ($item->user?->name)
                    <div class="flex nowrap">
                        <p class="w-[123px] uppercase tracking-wide text-sm text-gray-500 dark:text-gray-300 font-semibold border-r border-gray-600 dark:border-gray-300 pr-5 mr-5 flex-shrink-0">
                            {{ __('messages.postBy') }}
                        </p>
                        <p class="flex text-sm text-gray-600 dark:text-gray-200">
                            {{ $item->user?->name }} - {{ $item->created_at?->format('d-M-Y') }}
                        </p>
                    </div>
                @endif --}}
                    @if ($item->updated_at)
                        <div class="flex nowrap">
                            <p
                                class="w-[123px] uppercase tracking-wide text-sm text-gray-500 dark:text-gray-300 font-semibold border-r border-gray-600 dark:border-gray-300 pr-5 mr-5 flex-shrink-0">
                                {{ __('messages.lastUpdate') }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-200">
                                {{ $item->updated_at->format('d-M-Y') }}
                            </p>
                        </div>
                    @endif
                    @if ($item->keywords)
                        <div class="flex nowrap">
                            <p
                                class="w-[123px] uppercase tracking-wide text-sm text-gray-500 dark:text-gray-300 font-semibold border-r border-gray-600 dark:border-gray-300 pr-5 mr-5 flex-shrink-0">
                                {{ __('messages.keywords') }}
                            </p>
                            <p class="space-x-1 space-y-1 text-sm text-gray-600 dark:text-gray-200">
                                @foreach (explode(',', $item->keywords) as $keyword)
                                    <span
                                        class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 capitalize">
                                        {{ $keyword }}
                                    </span>
                                @endforeach
                            </p>
                        </div>
                    @endif
                </div>
                @if ($item->description)
                    <div class="mt-8">
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                            {{ __('messages.description') }}
                        </h2>
                        <div class="no-tailwind dark:text-white">
                            @if (app()->getLocale() == 'kh' && $item->name_kh)
                                {!! $item->description_kh !!}
                            @else
                                {!! $item->description !!}
                            @endif
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>
    <!-- End Detail -->

    <!-- Items -->
    <div class="max-w-screen-xl mx-auto mt-6">
        <div class="flex justify-between px-2 py-1 m-2 bg-primary xl:m-0">
            <p class="text-lg text-white">{{ __('messages.related') }}</p>
            <a href="{{ url('/publications') }}"
                class="flex items-center gap-2 text-lg text-white transition-all cursor-pointer hover:underline hover:translate-x-2">
                {{ __('messages.seeMore') }}
                <img src="{{ asset('assets/icons/right-arrow.png') }}" alt="" class="w-5 h-5" />
            </a>
        </div>
        <!-- Card Grid -->
        <div
            class="grid grid-cols-2 gap-2 py-2 m-2 lg:py-4 sm:grid-cols-3 md:grid-cols-3 xl:grid-cols-6 sm:gap-2 md:gap-4 lg:gap-6 xl:m-0">
            <!-- Card -->
            @forelse ($related_items as $item)
                <a class="block group" href="{{ url('publications/' . $item->id) }}">
                    <div class="w-full overflow-hidden bg-gray-100 border rounded-md shadow dark:bg-gray-800">
                        @if ($item->image)
                            <img class="w-full aspect-[6/9] group-hover:scale-110 transition-transform duration-500 ease-in-out object-cover rounded-md"
                                src="{{ asset('assets/images/publications/thumb/' . $item->image) }}"
                                alt="Image Description" />
                        @else
                            <div
                                class="aspect-{{ env('EPUB_ASPECT') }} rounded-md shadow overflow-hidden cursor-pointer relative">
                                <img class="w-full aspect-[{{ env('EPUB_ASPECT') }}] group-hover:scale-110 transition-transform duration-500 ease-in-out object-cover rounded-md"
                                    src="{{ asset('assets/book_cover_default.png') }}" alt="Image Description" />

                                <h1
                                    class="absolute block w-full p-4 text-lg font-bold text-center text-gray-700 transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                    @if (app()->getLocale() == 'kh' && $item->name_kh)
                                        {{ $item->name_kh }}
                                    @else
                                        {{ $item->name }}
                                    @endif
                                </h1>
                            </div>
                        @endif

                    </div>

                    <div class="relative pt-2" x-data="{ tooltipVisible: false }">
                        <h3 @mouseenter="tooltipVisible = true" @mouseleave="tooltipVisible = false"
                            class="relative block font-medium text-md text-black before:absolute before:bottom-[-0.1rem] before:start-0 before:-z-[1] before:w-full before:h-1 before:bg-lime-400 before:transition before:origin-left before:scale-x-0 group-hover:before:scale-x-100 dark:text-white mb-1">
                            <p class="line-clamp-1">{{ $item->name }}</p>
                        </h3>

                        <div x-show="tooltipVisible" x-transition
                            class="absolute z-10 px-3 py-2 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm dark:bg-gray-600"
                            style="display: none;">
                            {{ $item->name }}
                            <div class="tooltip-arrow"></div>
                        </div>
                    </div>
                </a>
            @empty
                <p class="dark:text-white">{{ __('messages.noData') }}</p>
            @endforelse
        </div>
        <!-- End Card Grid -->
    </div>
    <!-- End Items -->
@endsection
