@extends('layouts.client')
@section('content')
    <!-- client/components/search.blade.php -->
    <div
        class="sticky top-0 z-10 p-2 bg-white bg-gradient-to-r from-primary dark:from-primary dark:bg-gray-800 to-transparent">
        <div class="max-w-screen-xl mx-auto">
            <form class="w-full" action="{{ url('/one_search') }}">
                <div class="flex flex-wrap gap-2">
                    <!-- Search Database -->
                    <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                        class="text-gray-900 bg-gray-100 hover:bg-gray-200 focus:outline-none font-medium rounded-tl-lg rounded-tr-lg md:rounded-s-lg text-md px-5 py-2.5 text-center inline-flex items-center w-full md:w-auto justify-center md:rounded-tr-none border border-primary dark:bg-gray-700 dark:text-gray-200 dark:border-white dark:hover:bg-gray-600"
                        type="button">
                        @if (app()->getLocale() == 'kh' && 'ទាំងអស់')
                            {{ 'ទាំងអស់' }}
                        @else
                            {{ 'All' }}
                        @endif
                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="dropdown"
                        class="z-30 hidden w-auto bg-white border divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700">
                        <ul class="py-2 text-gray-700 text-md dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                            @forelse ($menu_databases as $item)
                                @if ($item->type == 'slug')
                                    <li>
                                        <a href="{{ url($item->slug) }}"
                                            class="menu-item-link block px-6 py-2 hover:bg-gray-100 {{ $item->name == 'All' ? 'underline' : '' }} dark:hover:bg-gray-600 dark:hover:text-white">
                                            {{ app()->getLocale() == 'kh' ? $item->name_kh : $item->name }}
                                        </a>
                                    </li>
                                @endif
                            @empty
                                <li>{{ __('messages.noData') }}...</li>
                            @endforelse
                        </ul>
                    </div>
                    <!-- End Search Database -->

                    <div class="flex flex-1">
                        <input type="search" id="search-dropdown" wire:model.live.debounce.300ms='search'
                            class="block p-2.5 w-full z-20 text-md text-gray-900 bg-gray-50 border-gray-50 border-1 border dark:bg-gray-700 dark:border-gray-300 dark:placeholder-gray-400 dark:text-white rounded-bl-lg md:rounded-bl-none focus:outline-double dark:focus:outline-white focus:outline-primary border-primary"
                            placeholder="{{ __('messages.search') }}..." name="search"
                            value="{{ request()->query('search') }}" />
                        <button type="submit"
                            class="top-0 end-0 p-2.5 text-md font-medium h-full text-white bg-primary rounded-e-lg border border-primary hover:bg-primaryHover focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-primary dark:hover:bg-primary dark:focus:ring-primaryHover flex space-x-2 items-center justify-center ml-2 rounded-tr-none md:rounded-tr-lg">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                            <span>{{ __('messages.search') }}</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('search-dropdown');
                const menuItems = document.querySelectorAll('.menu-item-link');

                searchInput.addEventListener('input', function() {
                    const query = searchInput.value;
                    menuItems.forEach(function(item) {
                        const baseUrl = item.getAttribute('href').split('?')[0];
                        item.setAttribute('href', baseUrl + '?search=' + encodeURIComponent(query));
                    });
                });
            });
        </script>
    </div>

    {{-- End Search --}}

    <!-- ====== Start Items ====== -->

    @forelse ($menu_databases as $database)
        @switch($database->slug)
            @case('publications')
                @if (count($publications) < 1)
                @break
            @endif
            {{-- E-Publications --}}
            <div class="max-w-screen-xl mx-auto mt-6">
                <div class="flex justify-between px-2 py-1 m-2 bg-primary xl:m-0">
                    <p class="text-lg text-white">{{ __('messages.ePublications') }}</p>
                    <a href="{{ url('/publications?search=' . request()->query('search')) }}"
                        class="flex items-center gap-2 text-lg text-white transition-all cursor-pointer hover:underline hover:translate-x-2">
                        {{ __('messages.seeMore') }}
                        <img src="{{ asset('assets/icons/right-arrow.png') }}" alt="" class="w-5 h-5" />
                    </a>
                </div>
                <!-- Card Grid -->
                <div
                    class="grid grid-cols-2 gap-4 py-2 m-2 lg:py-4 sm:grid-cols-3 md:grid-cols-4 xl:grid-cols-5 sm:gap-2 md:gap-4 lg:gap-4 xl:m-0">
                    <!-- Card -->
                    @forelse ($publications as $item)
                        <a class="block group" href="{{ url('/publications/' . $item->id) }}">
                            <div class="w-full overflow-hidden bg-gray-100 rounded-md dark:bg-neutral-800">
                                @if ($item->image)
                                    <img class="w-full border aspect-[{{ env('EPUB_ASPECT') }}] group-hover:scale-110 transition-transform duration-500 ease-in-out object-cover rounded-md"
                                        src="{{ asset('assets/images/publications/thumb/' . $item->image) }}"
                                        alt="Image Description" />
                                @else
                                    <div
                                        class="aspect-{{ env('EPUB_ASPECT') }} border rounded-md shadow overflow-hidden cursor-pointer relative">
                                        <img class="w-full border aspect-[{{ env('EPUB_ASPECT') }}] group-hover:scale-110 transition-transform duration-500 ease-in-out object-cover rounded-md"
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
                        <p class="p-2">{{ __('messages.noData') }}...</p>
                    @endforelse
                </div>
                <!-- End Card Grid -->
            </div>
        @break

        @case('videos')
            @if (count($videos) < 1)
            @break
        @endif
        {{-- Videos --}}
        <div class="max-w-screen-xl mx-auto mt-6">
            <div class="flex justify-between px-2 py-1 m-2 bg-primary xl:m-0">
                <p class="text-lg text-white">{{ __('messages.videos') }}</p>
                <a href="{{ url('/videos?search=' . request()->query('search')) }}"
                    class="flex items-center gap-2 text-lg text-white transition-all cursor-pointer hover:underline hover:translate-x-2">
                    {{ __('messages.seeMore') }}
                    <img src="{{ asset('assets/icons/right-arrow.png') }}" alt="" class="w-5 h-5" />
                </a>
            </div>
            <!-- Card Grid -->
            <div
                class="grid grid-cols-2 gap-4 py-2 m-2 lg:py-4 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4 sm:gap-2 md:gap-4 lg:gap-4 xl:m-0">
                <!-- Card -->
                @forelse ($videos as $item)
                    <a class="block group" href="{{ url('/videos/' . $item->id) }}">
                        <div class="w-full overflow-hidden bg-gray-100 rounded-md dark:bg-neutral-800">
                            <img class="w-full aspect-[{{ env('VIDEO_ASPECT') }}] group-hover:scale-110 transition-transform duration-500 ease-in-out object-cover rounded-md border"
                                src="{{ asset('assets/images/videos/thumb/' . $item->image) }}" alt="Image Description" />
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
                    <p class="p-2">{{ __('messages.noData') }}...</p>
                @endforelse

            </div>
            <!-- End Card Grid -->
        </div>
    @break

    @case('images')
        @if (count($images) < 1)
        @break
    @endif
    {{-- Images --}}
    <div class="max-w-screen-xl mx-auto mt-6">
        <div class="flex justify-between px-2 py-1 m-2 bg-primary xl:m-0">
            <p class="text-lg text-white">{{ __('messages.images') }}</p>
            <a href="{{ url('/images?search=' . request()->query('search')) }}"
                class="flex items-center gap-2 text-lg text-white transition-all cursor-pointer hover:underline hover:translate-x-2">
                {{ __('messages.seeMore') }}
                <img src="{{ asset('assets/icons/right-arrow.png') }}" alt="" class="w-5 h-5" />
            </a>
        </div>
        <!-- Card Grid -->
        <div
            class="grid grid-cols-2 gap-4 py-2 m-2 lg:py-4 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4 sm:gap-2 md:gap-4 lg:gap-4 xl:m-0">
            <!-- Card -->
            @forelse ($images as $item)
                <a class="block group" href="{{ url('/images/' . $item->id) }}">
                    <div class="w-full overflow-hidden bg-gray-100 rounded-md dark:bg-neutral-800">
                        <img class="w-full aspect-[{{ env('IMAGE_ASPECT') }}] group-hover:scale-110 transition-transform duration-500 ease-in-out object-cover rounded-md border"
                            src="{{ asset('assets/images/images/thumb/' . $item->image) }}"
                            alt="Image Description" />
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
                <p class="p-2">{{ __('messages.noData') }}...</p>
            @endforelse

        </div>
        <!-- End Card Grid -->
    </div>
@break

@case('audios')
    @if (count($audios) < 1)
    @break
@endif
{{-- Audios --}}
<div class="max-w-screen-xl mx-auto mt-6">
    <div class="flex justify-between px-2 py-1 m-2 bg-primary xl:m-0">
        <p class="text-lg text-white">{{ __('messages.audios') }}</p>
        <a href="{{ url('/audios?search=' . request()->query('search')) }}"
            class="flex items-center gap-2 text-lg text-white transition-all cursor-pointer hover:underline hover:translate-x-2">
            {{ __('messages.seeMore') }}
            <img src="{{ asset('assets/icons/right-arrow.png') }}" alt="" class="w-5 h-5" />
        </a>
    </div>
    <!-- Card Grid -->
    <div
        class="grid grid-cols-2 gap-4 py-2 m-2 lg:py-4 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4 sm:gap-2 md:gap-4 lg:gap-4 xl:m-0">
        <!-- Card -->
        @forelse ($audios as $item)
            <a class="block group" href="{{ url('/audios/' . $item->id) }}">
                <div class="w-full overflow-hidden bg-gray-100 rounded-md dark:bg-gray-800">
                    @if ($item->image)
                        <img class="w-full aspect-[{{ env('AUDIO_ASPECT') }}] group-hover:scale-110 transition-transform duration-500 ease-in-out object-cover rounded-md border"
                            src="{{ asset('assets/images/audios/thumb/' . $item->image) }}"
                            alt="Image Description" />
                    @else
                        <img class="w-full aspect-[{{ env('AUDIO_ASPECT') }}] group-hover:scale-110 transition-transform duration-500 ease-in-out object-contain p-8 rounded-md border"
                            src="{{ asset('assets/icons/audio_placeholder.png') }}" alt="Image Description" />
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
            <p class="p-2">{{ __('messages.noData') }}...</p>
        @endforelse

    </div>
    <!-- End Card Grid -->
</div>
@break

@case('bulletins')
@if (count($bulletins) < 1)
@break
@endif
{{-- Start Bulletins --}}
<div class="max-w-screen-xl mx-auto mt-6">
<div class="flex justify-between px-2 py-1 m-2 bg-primary xl:m-0">
    <p class="text-lg text-white">{{ __('messages.bulletins') }}</p>
    <a href="{{ url('/bulletins?search=' . request()->query('search')) }}"
        class="flex items-center gap-2 text-lg text-white transition-all cursor-pointer hover:underline hover:translate-x-2">
        {{ __('messages.seeMore') }}
        <img src="{{ asset('assets/icons/right-arrow.png') }}" alt="" class="w-5 h-5" />
    </a>
</div>
<!-- Card Grid -->
<div
    class="grid grid-cols-2 gap-4 py-2 m-2 lg:py-4 sm:grid-cols-3 md:grid-cols-4 xl:grid-cols-5 sm:gap-2 md:gap-4 lg:gap-4 xl:m-0">
    <!-- Card -->
    @forelse ($bulletins as $item)
        <a class="block group" href="{{ url('/bulletins/' . $item->id) }}">
            <div class="w-full overflow-hidden bg-gray-100 rounded-md dark:bg-neutral-800">
                @if ($item->image)
                    <img class="w-full border aspect-[{{ env('BULLETIN_ASPECT') }}] group-hover:scale-110 transition-transform duration-500 ease-in-out object-cover rounded-md"
                        src="{{ asset('assets/images/news/thumb/' . $item->image) }}"
                        alt="Image Description" />
                @else
                    <div
                        class="aspect-{{ env('BULLETIN_ASPECT') }} border rounded-md shadow overflow-hidden cursor-pointer relative">
                        <img class="w-full border aspect-[{{ env('BULLETIN_ASPECT') }}] group-hover:scale-110 transition-transform duration-500 ease-in-out object-cover rounded-md"
                            src="{{ asset('assets/book_cover_default.png') }}" alt="Image Description" />

                        <h1
                            class="absolute block w-full p-4 text-lg font-bold text-center text-gray-700 transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                            @if (app()->getLocale() == 'kh' && $item->name_kh)
                                {{ $item->name_kh }}
                            @else
                                {{ $item->name }}
                            @endif
                        </h1>
                        <p
                            class="absolute bottom-0 block w-full pr-2 text-sm font-medium leading-9 text-right text-gray-700 dark:text-gray-100">
                            {{ $item->author?->name }}
                        </p>
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
        <p class="p-2">{{ __('messages.noData') }}...</p>
    @endforelse
</div>
<!-- End Card Grid -->
</div>
{{-- End Bulletins --}}
@break

@case('theses')
@if (count($theses) < 1)
@break
@endif
{{-- Start Theses --}}
<div class="max-w-screen-xl mx-auto mt-6">
<div class="flex justify-between px-2 py-1 m-2 bg-primary xl:m-0">
<p class="text-lg text-white">{{ __('messages.theses') }}</p>
<a href="{{ url('/theses?search=' . request()->query('search')) }}"
    class="flex items-center gap-2 text-lg text-white transition-all cursor-pointer hover:underline hover:translate-x-2">
    {{ __('messages.seeMore') }}
    <img src="{{ asset('assets/icons/right-arrow.png') }}" alt="" class="w-5 h-5" />
</a>
</div>
<!-- Card Grid -->
<div
class="grid grid-cols-2 gap-4 py-2 m-2 lg:py-4 sm:grid-cols-3 md:grid-cols-4 xl:grid-cols-5 sm:gap-2 md:gap-4 lg:gap-4 xl:m-0">
<!-- Card -->
@forelse ($theses as $item)
    <a class="block group" href="{{ url('/theses/' . $item->id) }}">
        <div class="w-full overflow-hidden bg-gray-100 rounded-md dark:bg-neutral-800">
            @if ($item->image)
                <img class="w-full border aspect-[{{ env('THESIS_ASPECT') }}] group-hover:scale-110 transition-transform duration-500 ease-in-out object-cover rounded-md"
                    src="{{ asset('assets/images/theses/thumb/' . $item->image) }}"
                    alt="Image Description" />
            @else
                <div
                    class="aspect-{{ env('THESIS_ASPECT') }} border rounded-md shadow overflow-hidden cursor-pointer relative">
                    <img class="w-full border aspect-[{{ env('THESIS_ASPECT') }}] group-hover:scale-110 transition-transform duration-500 ease-in-out object-cover rounded-md"
                        src="{{ asset('assets/book_cover_default.png') }}" alt="Image Description" />

                    <h1
                        class="absolute block w-full p-4 text-lg font-bold text-center text-gray-700 transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                        @if (app()->getLocale() == 'kh' && $item->name_kh)
                            {{ $item->name_kh }}
                        @else
                            {{ $item->name }}
                        @endif
                    </h1>
                    <p
                        class="absolute bottom-0 block w-full pr-2 text-sm font-medium leading-9 text-right text-gray-700 dark:text-gray-100">
                        {{ $item->author?->name }}
                    </p>
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
    <p class="p-2">{{ __('messages.noData') }}...</p>
@endforelse
</div>
<!-- End Card Grid -->
</div>
{{-- End Theses --}}
@break

@case('journals')
@if (count($journals) < 1)
@break
@endif
{{-- Start Journal --}}
<div class="max-w-screen-xl mx-auto mt-6">
<div class="flex justify-between px-2 py-1 m-2 bg-primary xl:m-0">
<p class="text-lg text-white">{{ __('messages.journals') }}</p>
<a href="{{ url('/journals?search=' . request()->query('search')) }}"
class="flex items-center gap-2 text-lg text-white transition-all cursor-pointer hover:underline hover:translate-x-2">
{{ __('messages.seeMore') }}
<img src="{{ asset('assets/icons/right-arrow.png') }}" alt="" class="w-5 h-5" />
</a>
</div>
<!-- Card Grid -->
<div
class="grid grid-cols-2 gap-4 py-2 m-2 lg:py-4 sm:grid-cols-3 md:grid-cols-4 xl:grid-cols-5 sm:gap-2 md:gap-4 lg:gap-4 xl:m-0">
<!-- Card -->
@forelse ($journals as $item)
<a class="block group" href="{{ url('/journals/' . $item->id) }}">
    <div class="w-full overflow-hidden bg-gray-100 rounded-md dark:bg-neutral-800">
        @if ($item->image)
            <img class="w-full border aspect-[{{ env('JOURNAL_ASPECT') }}] group-hover:scale-110 transition-transform duration-500 ease-in-out object-cover rounded-md"
                src="{{ asset('assets/images/journals/thumb/' . $item->image) }}"
                alt="Image Description" />
        @else
            <div
                class="aspect-{{ env('JOURNAL_ASPECT') }} border rounded-md shadow overflow-hidden cursor-pointer relative">
                <img class="w-full border aspect-[{{ env('JOURNAL_ASPECT') }}] group-hover:scale-110 transition-transform duration-500 ease-in-out object-cover rounded-md"
                    src="{{ asset('assets/book_cover_default.png') }}" alt="Image Description" />

                <h1
                    class="absolute block w-full p-4 text-lg font-bold text-center text-gray-700 transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                    @if (app()->getLocale() == 'kh' && $item->name_kh)
                        {{ $item->name_kh }}
                    @else
                        {{ $item->name }}
                    @endif
                </h1>
                <p
                    class="absolute bottom-0 block w-full pr-2 text-sm font-medium leading-9 text-right text-gray-700 dark:text-gray-100">
                    {{ $item->author?->name }}
                </p>
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
<p class="p-2">{{ __('messages.noData') }}...</p>
@endforelse
</div>
<!-- End Card Grid -->
</div>
{{-- End Journal --}}
@break

@case('articles')
@if (count($articles) < 1)
@break
@endif
{{-- Start Journal --}}
<div class="max-w-screen-xl mx-auto mt-6">
<div class="flex justify-between px-2 py-1 m-2 bg-primary xl:m-0">
<p class="text-lg text-white">{{ __('messages.articles') }}</p>
<a href="{{ url('/articles?search=' . request()->query('search')) }}"
class="flex items-center gap-2 text-lg text-white transition-all cursor-pointer hover:underline hover:translate-x-2">
{{ __('messages.seeMore') }}
<img src="{{ asset('assets/icons/right-arrow.png') }}" alt="" class="w-5 h-5" />
</a>
</div>
<!-- Card Grid -->
<div
class="grid grid-cols-2 gap-4 py-2 m-2 lg:py-4 sm:grid-cols-3 md:grid-cols-4 xl:grid-cols-5 sm:gap-2 md:gap-4 lg:gap-4 xl:m-0">
<!-- Card -->
@forelse ($articles as $item)
<a class="block group" href="{{ url('/articles/' . $item->id) }}">
<div class="w-full overflow-hidden bg-gray-100 rounded-md dark:bg-neutral-800">
    @if ($item->image)
        <img class="w-full border aspect-[{{ env('ARTICLE_ASPECT') }}] group-hover:scale-110 transition-transform duration-500 ease-in-out object-cover rounded-md"
            src="{{ asset('assets/images/articles/thumb/' . $item->image) }}"
            alt="Image Description" />
    @else
        <div
            class="aspect-{{ env('ARTICLE_ASPECT') }} border rounded-md shadow overflow-hidden cursor-pointer relative">
            <img class="w-full border aspect-[{{ env('ARTICLE_ASPECT') }}] group-hover:scale-110 transition-transform duration-500 ease-in-out object-cover rounded-md"
                src="{{ asset('assets/book_cover_default.png') }}" alt="Image Description" />

            <h1
                class="absolute block w-full p-4 text-lg font-bold text-center text-gray-700 transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                @if (app()->getLocale() == 'kh' && $item->name_kh)
                    {{ $item->name_kh }}
                @else
                    {{ $item->name }}
                @endif
            </h1>
            <p
                class="absolute bottom-0 block w-full pr-2 text-sm font-medium leading-9 text-right text-gray-700 dark:text-gray-100">
                {{ $item->author?->name }}
            </p>
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
<p class="p-2">{{ __('messages.noData') }}...</p>
@endforelse
</div>
<!-- End Card Grid -->
</div>
{{-- End Journal --}}
@break

@endswitch
@empty
<p class="max-w-screen-xl py-6 mx-auto">{{ __('messages.noData') }}...</p>
@endforelse

<!-- ===== End Items ===== -->
@endsection
