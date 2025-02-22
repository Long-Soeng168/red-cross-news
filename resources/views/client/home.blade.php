@extends('layouts.client')
@section('content')
    {{-- Start Search --}}
    @include('client.components.search', [
        'actionUrl' => url('/' . $menu_database_default->slug),
        'title' => $menu_database_default->name,
        'title_kh' => $menu_database_default->name_kh,
    ])
    {{-- End Search --}}

    <!-- Slide Show -->
    <div class="max-w-screen-xl p-2 mx-auto">
        <swiper-container autoplay="true" autoplay-delay="2000" speed="1000" effect="slide" class="mySwiper" pagination="true"
            pagination-clickable="true" space-between="30" loop="true">
            @forelse ($slides as $slide)
                <swiper-slide class="swiper-slide-item">
                    <a href="{{ asset('assets/images/slides/' . $slide->image) }}" class="w-full glightbox">
                        <img class="object-cover w-full swiper-slide-img"
                            src="{{ asset('assets/images/slides/thumb/' . $slide->image) }}" alt="" />
                    </a>
                </swiper-slide>
            @empty
            @endforelse
        </swiper-container>

        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
    </div>
    <!-- End Slide Show -->

    <!-- Start Database -->
    <div class="max-w-screen-xl px-2 mx-auto mt-4">
        {{-- <p class="mb-2 text-xl font-bold text-gray-700 uppercase textmax-w-2xl dark:text-white xl:p-0">
            {{ __('messages.databases') }}
        </p> --}}
        <!-- Icon Blocks -->
        <div class="">
            <div>
                <swiper-container class="w-full swiper-responsive" effect="slide" pagination="true" {{-- space-between="30" --}}
                    {{-- loop="true" --}} init="false">
                    @forelse ($menu_databases as $index => $database)
                        <swiper-slide class="flex items-center justify-center object-contain py-1 rounded-xl">
                            @if ($database->type == 'slug')
                                <a href="{{ url('/' . $database->slug) }}"
                                    class="flex flex-col items-center justify-center w-full p-4 py-6
                                {{-- {{ request()->is($database->slug . '*') ? 'bg-gray-100' : '' }}  --}}
                                 dark:bg-gray-800 group hover:bg-gray-200 rounded-xl dark:hover:bg-gray-600 bg-[{{ $database->light_mode_color }}]">
                                    <img class="object-contain h-16 aspect-square swiper-responsive-img"
                                        src="{{ asset('assets/images/databases/' . $database->client_side_image) }}"
                                        alt="">
                                    <h3
                                        class="mt-1 font-semibold text-gray-800 group-hover:text-gray-600 text-md lg:text-lg whitespace-nowrap dark:text-gray-300 dark:group-hover:text-gray-50">
                                        @if (app()->getLocale() == 'kh' && $database->name_kh)
                                            {{ $database->name_kh }}
                                        @else
                                            {{ $database->name }}
                                        @endif
                                    </h3>
                                </a>
                            @else
                                <a href="{{ $database->link ? $database->link : '#' }}" target="_blank"
                                    class="flex flex-col items-center justify-center w-full p-4 py-6
                                {{-- {{ request()->is($database->slug . '*') ? 'bg-gray-100' : '' }}  --}}
                                 dark:bg-gray-800 group hover:bg-gray-200 rounded-xl dark:hover:bg-gray-600 bg-[{{ $database->light_mode_color }}]">
                                    <img class="object-contain h-16 aspect-square swiper-responsive-img"
                                        src="{{ asset('assets/images/databases/' . $database->client_side_image) }}"
                                        alt="">
                                    <h3
                                        class="mt-1 font-semibold text-gray-800 group-hover:text-gray-600 text-md lg:text-lg whitespace-nowrap dark:text-gray-300 dark:group-hover:text-gray-50">
                                        {{ $database->name }}
                                    </h3>
                                </a>
                            @endif
                        </swiper-slide>
                    @empty
                        <p class="py-4">{{ __('messages.noData') }}...</p>
                    @endforelse
                </swiper-container>


                <script>
                    const swiperEl = document.querySelector('.swiper-responsive')
                    Object.assign(swiperEl, {
                        slidesPerView: 3,
                        spaceBetween: 5,
                        breakpoints: {
                            640: {
                                slidesPerView: 3,
                                spaceBetween: 5,
                            },
                            768: {
                                slidesPerView: 4,
                                spaceBetween: 5,
                            },
                            1024: {
                                // slidesPerView: 7,
                                slidesPerView: {{ count($menu_databases) }},
                                spaceBetween: 5,
                            },
                        },
                    });
                    swiperEl.initialize();
                </script>
            </div>

        </div>
        <!-- End Icon Blocks -->
    </div>
    <!-- End Database -->

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
                    <a href="{{ url('/publications') }}"
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
                            <div class="w-full overflow-hidden bg-gray-100 rounded-md dark:bg-neutral-800 ">
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
                                    <p class="line-clamp-{{ env('Limit_Line') }}">{{ $item->name }}</p>
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
                <a href="{{ url('/videos') }}"
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
                                <p class="line-clamp-{{ env('Limit_Line') }}">{{ $item->name }}</p>
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
        @case('jstors')
            @if (count($jstors) < 1)
            @break
        @endif
        {{-- jstors --}}
        <div class="max-w-screen-xl mx-auto mt-6">
            <div class="flex justify-between px-2 py-1 m-2 bg-primary xl:m-0">
                <p class="text-lg text-white">{{ __('messages.jstors') }}</p>
                <a href="{{ url('/jstors') }}"
                    class="flex items-center gap-2 text-lg text-white transition-all cursor-pointer hover:underline hover:translate-x-2">
                    {{ __('messages.seeMore') }}
                    <img src="{{ asset('assets/icons/right-arrow.png') }}" alt="" class="w-5 h-5" />
                </a>
            </div>
            <!-- Card Grid -->
            <div
                class="grid grid-cols-2 gap-4 py-2 m-2 lg:py-4 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 sm:gap-2 md:gap-4 lg:gap-4 xl:m-0">
                <!-- Card -->
                @forelse ($jstors as $item)
                    <a class="block group" href="{{ url('/jstors/' . $item->id) }}">
                        <div class="w-full overflow-hidden bg-gray-100 rounded-md dark:bg-neutral-800">
                            <img class="w-full aspect-[{{ env('EPUB_ASPECT') }}] group-hover:scale-110 transition-transform duration-500 ease-in-out object-cover rounded-md border"
                                src="{{ 'https://www.thnal.com/assets/images/publications/thumb/' . $item->image }}" alt="Image Description" />
                        </div>

                        <div class="relative pt-2" x-data="{ tooltipVisible: false }">
                            <h3 @mouseenter="tooltipVisible = true" @mouseleave="tooltipVisible = false"
                                class="relative block font-medium text-md text-black before:absolute before:bottom-[-0.1rem] before:start-0 before:-z-[1] before:w-full before:h-1 before:bg-lime-400 before:transition before:origin-left before:scale-x-0 group-hover:before:scale-x-100 dark:text-white mb-1">
                                <p class="line-clamp-{{ env('Limit_Line') }}">{{ $item->name }}</p>
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
            <a href="{{ url('/images') }}"
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
                            <p class="line-clamp-{{ env('Limit_Line') }}">{{ $item->name }}</p>
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
        <a href="{{ url('/audios') }}"
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
                        <p class="line-clamp-{{ env('Limit_Line') }}">{{ $item->name }}</p>
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
    <a href="{{ url('/bulletins') }}"
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
                    </div>
                @endif
            </div>

            <div class="relative pt-2" x-data="{ tooltipVisible: false }">
                <h3 @mouseenter="tooltipVisible = true" @mouseleave="tooltipVisible = false"
                    class="relative block font-medium text-md text-black before:absolute before:bottom-[-0.1rem] before:start-0 before:-z-[1] before:w-full before:h-1 before:bg-lime-400 before:transition before:origin-left before:scale-x-0 group-hover:before:scale-x-100 dark:text-white mb-1">
                    <p class="line-clamp-{{ env('Limit_Line') }}">{{ $item->name }}</p>
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
<a href="{{ url('/theses') }}"
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
                </div>
            @endif

        </div>

        <div class="relative pt-2" x-data="{ tooltipVisible: false }">
            <h3 @mouseenter="tooltipVisible = true" @mouseleave="tooltipVisible = false"
                class="relative block font-medium text-md text-black before:absolute before:bottom-[-0.1rem] before:start-0 before:-z-[1] before:w-full before:h-1 before:bg-lime-400 before:transition before:origin-left before:scale-x-0 group-hover:before:scale-x-100 dark:text-white mb-1">
                <p class="line-clamp-{{ env('Limit_Line') }}">{{ $item->name }}</p>
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
<a href="{{ url('/journals') }}"
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
            </div>
        @endif

    </div>

    <div class="relative pt-2" x-data="{ tooltipVisible: false }">
        <h3 @mouseenter="tooltipVisible = true" @mouseleave="tooltipVisible = false"
            class="relative block font-medium text-md text-black before:absolute before:bottom-[-0.1rem] before:start-0 before:-z-[1] before:w-full before:h-1 before:bg-lime-400 before:transition before:origin-left before:scale-x-0 group-hover:before:scale-x-100 dark:text-white mb-1">
            <p class="line-clamp-{{ env('Limit_Line') }}">{{ $item->name }}</p>
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
<a href="{{ url('/articles') }}"
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

        </div>
    @endif

</div>

<div class="relative pt-2" x-data="{ tooltipVisible: false }">
    <h3 @mouseenter="tooltipVisible = true" @mouseleave="tooltipVisible = false"
        class="relative block font-medium text-md text-black before:absolute before:bottom-[-0.1rem] before:start-0 before:-z-[1] before:w-full before:h-1 before:bg-lime-400 before:transition before:origin-left before:scale-x-0 group-hover:before:scale-x-100 dark:text-white mb-1">
        <p class="line-clamp-{{ env('Limit_Line') }}">{{ $item->name }}</p>
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
