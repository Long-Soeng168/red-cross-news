<div>
    <!-- Search -->
    <div class="p-2 bg-gradient-to-r from-primary to-transparent" id="top-title">
        <div class="max-w-screen-xl mx-auto">
            <form class="w-full " action="{{ url('/theses') }}">
                <div class="flex flex-wrap gap-2">
                    <!-- Search Database -->
                    <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                        class="text-gray-900 bg-gray-100 hover:bg-gray-200 focus:outline-none   font-medium rounded-tl-lg rounded-tr-lg md:rounded-s-lg text-md px-5 py-2.5 text-center inline-flex items-center  w-full md:w-auto justify-center md:rounded-tr-none border border-primary dark:bg-gray-700 dark:text-gray-200 dark:border-white dark:hover:bg-gray-600"
                        type="button">
                        {{ __('messages.theses') }}
                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="dropdown"
                        class="z-30 hidden w-auto bg-white border divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700">
                        <ul class="py-2 text-gray-700 text-md dark:text-gray-200"
                            aria-labelledby="dropdownDefaultButton">
                            @forelse ($menu_databases as $item)
                                @if ($item->type == 'slug')
                                    <li>
                                        <a href="{{ url($item->slug) }}"
                                            class="block px-6 py-2 hover:bg-gray-100 {{ request()->is($item->slug) ? 'underline' : '' }} dark:hover:bg-gray-600 dark:hover:text-white">
                                            @if (app()->getLocale() == 'kh' && $item->name_kh)
                                                {{ $item->name_kh }}
                                            @else
                                                {{ $item->name }}
                                            @endif

                                        </a>
                                    </li>
                                @endif
                            @empty

                            @endforelse
                        </ul>
                    </div>
                    <!-- End Search Database -->

                    <!-- Start Filter -->
                    <button id="multiLevelDropdownButton" data-dropdown-toggle="multi-dropdown"
                        class="text-gray-900 bg-gray-100 hover:bg-gray-200 focus:outline-none font-medium text-md px-5 py-2.5 text-center inline-flex items-center  w-full md:w-auto justify-center border border-primary dark:bg-gray-700 dark:text-gray-200 dark:border-white dark:hover:bg-gray-600"
                        type="button">
                        {{ __('messages.filter') }}
                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="multi-dropdown"
                        class="z-30 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-[250px] dark:bg-gray-700 border"
                        wire:ignore>
                        <ul class="py-2 text-sm text-gray-700 border-none dark:text-gray-200 max-h-[600px] overflow-scroll"
                            aria-labelledby="multiLevelDropdownButton">
                            @forelse ($categories as $category)
                                <li class="hover:underline" wire:key="{{ $category->id }}">
                                    <div class="flex items-center flex-1 gap-2 pl-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                        wire:change="handleSelectCategory({{ $category->id }})">
                                        <input type="checkbox" id="category-{{ $category->id }}"
                                            name="selected_categories[]" value="{{ $category->id }}">
                                        <label class="flex-1 py-2 pr-2" for="category-{{ $category->id }}">
                                            @if (app()->getLocale() == 'kh' && $category->name_kh)
                                                {{ $category->name_kh }}
                                            @else
                                                {{ $category->name }}
                                            @endif
                                        </label>
                                    </div>
                                </li>
                                {{-- @if (count($category->subCategories) < 1)
                                    <li class="hover:underline" wire:key="{{ $category->id }}">
                                        <div class="flex items-center flex-1 gap-2 pl-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" wire:change="handleSelectCategory({{ $category->id }})">
                                            <input type="checkbox" id="category-{{ $category->id }}" name="selected_categories[]" value="{{ $category->id }}">
                                            <label class="flex-1 py-2 pr-2" for="category-{{ $category->id }}">
                                                @if (app()->getLocale() == 'kh' && $category->name_kh)
                                                {{ $category->name_kh }}
                                                @else
                                                {{ $category->name }}
                                                @endif
                                            </label>
                                        </div>
                                    </li>
                                @else
                                    <li class="hover:underline" wire:key="{{ $category->id }}">
                                        <div class="flex">
                                            <div class="flex items-center flex-1 gap-2 pl-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" wire:change="handleSelectCategory({{ $category->id }})">
                                                <input type="checkbox" id="category-{{ $category->id }}" name="selected_categories[]" value="{{ $category->id }}">
                                                <label class="flex-1 py-2 pr-2" for="category-{{ $category->id }}">
                                                    @if (app()->getLocale() == 'kh' && $category->name_kh)
                                                    {{ $category->name_kh }}
                                                    @else
                                                    {{ $category->name }}
                                                    @endif
                                                </label>
                                            </div>
                                            <button id="doubleDropdownButton-{{ $category->id }}" data-dropdown-toggle="doubleDropdown-{{ $category->id }}"
                                                data-dropdown-placement="bottom-start" type="button"
                                                class="flex items-center justify-between px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                <svg class="w-3 h-3 rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                                                </svg>
                                            </button>
                                        </div>
                                        <div id="doubleDropdown-{{ $category->id }}"
                                            class="relative z-30 hidden bg-gray-50 divide-y divide-gray-200 border shadow-lg w-[250px]  dark:bg-gray-500 ml-2">
                                            <div class="py-1 font-bold text-center underline bg-gray-200 border-b border-b-primary dark:border-b-white dark:bg-gray-600">
                                                @if (app()->getLocale() == 'kh' && $category->name_kh)
                                                {{ $category->name_kh }}
                                                @else
                                                {{ $category->name }}
                                                @endif
                                            </div>
                                            <ul class="text-sm text-gray-700 dark:text-gray-100" aria-labelledby="doubleDropdownButton-{{ $category->id }}">
                                                @forelse ($category->subCategories as $subCategory)
                                                    <li class="hover:underline" wire:key="{{ $subCategory->id }}">
                                                        <div class="flex items-center flex-1 gap-2 pl-2 hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white" wire:change="handleSelectSubCategory({{ $subCategory->id }})">
                                                            <input type="checkbox" id="subCategory-{{ $subCategory->id }}" name="selected_sub_categories[]" value="{{ $subCategory->id }}">
                                                            <label class="flex-1 py-2 pr-2" for="subCategory-{{ $subCategory->id }}">
                                                                @if (app()->getLocale() == 'kh' && $subCategory->name_kh)
                                                                {{ $subCategory->name_kh }}
                                                                @else
                                                                {{ $subCategory->name }}
                                                                @endif
                                                            </label>
                                                        </div>
                                                    </li>
                                                @empty
                                                    <li class="py-2 text-center">No subcategories available</li>
                                                @endforelse
                                            </ul>
                                        </div>
                                    </li>
                                @endif --}}
                            @empty
                                <li class="py-2 text-center">No categories available</li>
                            @endforelse
                        </ul>
                    </div>


                    <div class="flex flex-1">
                        <input type="search" id="search-dropdown" wire:model.live.debounce.300ms='search'
                            class="block p-2.5 w-full z-20 text-md text-gray-900 bg-gray-50 border-gray-50 border-1 border  dark:bg-gray-700 dark:border-gray-300 dark:placeholder-gray-400 dark:text-white rounded-bl-lg md:rounded-bl-none focus:outline-double dark:focus:outline-white focus:outline-primary  border-primary"
                            placeholder="{{ __('messages.search') }}..." name="search" />
                        <button type="button"
                            class="top-0 end-0 p-2.5 text-md font-medium h-full text-white bg-primary rounded-e-lg border border-primary hover:bg-primaryHover focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-primary dark:hover:bg-primary dark:focus:ring-primaryHover flex space-x-2 items-center justify-center ml-2 rounded-tr-none md:rounded-tr-lg">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                            <span>{{ __('messages.search') }}</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End Search -->

    <div class="max-w-screen-xl grid-cols-12 px-2 mx-auto lg:grid xl:px-0">
        <!-- Start Database -->
        <div wire:ignore id="accordion-collapse" data-accordion="collapse" class="col-span-1 mt-6">
            <h2 id="accordion-collapse-heading-2">
                <button
                    class="flex items-center justify-between w-full gap-2 px-2 py-[3px] mb-4 border bg-inherit lg:hidden"
                    data-accordion-target="#accordion-collapse-body-2" aria-expanded="true"
                    aria-controls="accordion-collapse-body-2">
                    <p class="text-lg font-bold text-gray-700 uppercase dark:text-gray-200">
                        {{ __('messages.databases') }}
                    </p>
                    <svg data-accordion-icon class="w-4 h-4 text-gray-700 rotate-180 shrink-0 dark:text-gray-300"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5 5 1 1 5" />
                    </svg>
                </button>
            </h2>
            <div id="accordion-collapse-body-2" class="hidden lg:block" aria-labelledby="accordion-collapse-heading-2">
                <div>
                    <!-- Icon Blocks -->
                    <div class="">
                        <div class="grid items-center grid-cols-3 gap-4 sm:grid-cols-3 lg:grid-cols-1">
                            @forelse ($menu_databases as $index => $database)
                                @if ($database->type == 'slug')
                                    <a class="{{ $database->slug == 'theses' ? 'bg-gray-200 dark:bg-gray-700' : '' }} flex flex-col items-center justify-center p-2 group hover:bg-gray-100 rounded-xl dark:hover:bg-gray-600 "
                                        href="{{ url('/' . $database->slug) }}">
                                        <div
                                            class="flex items-center justify-center object-contain w-12 aspect-square rounded-xl">
                                            <img src="{{ asset('assets/images/databases/' . $database->client_side_image) }}"
                                                alt="" class="object-contain w-full" />
                                        </div>
                                        <div class="mt-1">
                                            <h3
                                                class="text-sm text-center text-gray-800 group-hover:text-gray-600 dark:text-gray-300 dark:group-hover:text-gray-50">
                                                @if (app()->getLocale() == 'kh' && $database->name_kh)
                                                    {{ $database->name_kh }}
                                                @else
                                                    {{ $database->name }}
                                                @endif
                                            </h3>
                                        </div>
                                    </a>
                                @endif
                            @empty
                                <p class="py-4">{{ __('messages.noData') }}...</p>
                            @endforelse


                        </div>
                    </div>
                    <!-- End Icon Blocks -->
                </div>
            </div>
        </div>
        <!-- End Database -->

        <!-- Items -->
        <div class="col-span-11 lg:pl-4">
            <div class="max-w-screen-xl mx-auto mt-6">
                <div class="flex justify-between px-2 py-1 bg-primary">
                    <p class="text-lg text-white capitalize">
                        {{ __('messages.theses') }}
                    </p>
                </div>
                @if ($selected_categories_item || $selected_sub_categories_item)
                    <div class="relative flex flex-wrap gap-2 p-2 pt-4 mt-4 border rounded-md shadow-md">
                        @forelse ($selected_categories_item as $index => $item)
                            <div class="relative flex gap-1 rounded-sm group dark:bg-blue-400/50 bg-blue-400/20"
                                wire:key="{{ $item->id }}-{{ $index }}">
                                <div class="flex items-center gap-2 p-2 text-gray-800 rounded-md dark:text-white">
                                    @if (app()->getLocale() == 'kh' && $item->name_kh)
                                        {{ $item->name_kh }}
                                    @else
                                        {{ $item->name }}
                                    @endif
                                </div>
                                <button wire:click="handleRemoveCategoryName({{ $item }})"
                                    class="px-1.5 my-1.5 dark:text-white text-gray-700 duration-300 border-l borderdark:bg-blue-400/40 border-l-blue-600/50 dark:border-l-white">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        @empty
                        @endforelse

                        @forelse ($selected_sub_categories_item as $index => $item)
                            <div class="relative flex gap-1 rounded-sm group dark:bg-blue-400/30 bg-blue-400/10"
                                wire:key="{{ $item->id }}-{{ $index }}">
                                <div class="flex items-center gap-2 p-2 text-gray-800 rounded-md dark:text-white">
                                    @if (app()->getLocale() == 'kh' && $item->name_kh)
                                        {{ $item->name_kh }}
                                    @else
                                        {{ $item->name }}
                                    @endif
                                </div>
                                <button wire:click="handleRemoveSubCategoryName({{ $item }})"
                                    class="px-1.5 my-1.5 dark:text-white text-gray-700 duration-300 border-l borderdark:bg-blue-400/40 border-l-blue-600/50 dark:border-l-white">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        @empty
                        @endforelse

                        {{-- Filter top title --}}
                        <div
                            class="absolute px-2 duration-300 bg-white border-l border-r dark:bg-gray-800 dark:text-white -top-2.5 left-2">
                            <p class="text-sm font-bold">{{ __('messages.filter') }}</p>
                        </div>

                        {{-- Button Clear all --}}
                        <button wire:click="handleClearAllFilter"
                            class="absolute p-0.5 text-white duration-300 bg-red-400 rounded-full -top-2.5 -right-2.5">
                            <svg class="w-5 h-5 rounded-full" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                @endif

                <div
                    class="grid grid-cols-2 gap-2 py-2 lg:py-4 sm:grid-cols-3 md:grid-cols-4 xl:grid-cols-5 sm:gap-2 md:gap-4 lg:gap-6">
                    <!-- Card -->
                    @forelse ($items as $index => $item)

                        <a wire:key="{{ $item->id }}-{{ $index }}" class="block group"
                            href="{{ url('theses/' . $item->id) }}">
                            <div class="w-full overflow-hidden bg-gray-100 border rounded-md dark:bg-neutral-800">
                                @if ($item->image)
                                    <img class="w-full aspect-[{{ env('THESIS_ASPECT') }}] group-hover:scale-110 transition-transform duration-500 ease-in-out object-cover rounded-md"
                                        src="{{ asset('assets/images/theses/thumb/' . $item->image) }}"
                                        alt="Image Description" />
                                @else
                                    <div
                                        class="aspect-{{ env('THESIS_ASPECT') }} rounded-md shadow overflow-hidden cursor-pointer relative">
                                        <img class="w-full aspect-[{{ env('THESIS_ASPECT') }}] group-hover:scale-110 transition-transform duration-500 ease-in-out object-cover rounded-md"
                                            src="{{ asset('assets/book_cover_default.png') }}"
                                            alt="Image Description" />

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
                        <p class="text-gray-700 dark:text-gray-200">{{ __('messages.noData') }}...</p>
                    @endforelse
                </div>
                <!-- End Card Grid -->
            </div>
            <!-- End Items -->
            <!-- Pagination -->
            <div>
                <div class="max-w-[200px] my-2 flex gap-2 items-center">
                    <label for="countries"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 whitespace-nowrap">
                        {{ __('messages.recordsPerPage') }} :
                    </label>
                    <select id="countries" wire:model.live='perPage'
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>

                {{ $items->links('vendor.pagination.custom') }}

            </div>
            <!-- End Pagination -->
        </div>
    </div>
    @script
        $wire.on('livewire:updatedPage', () => {
        window.location.reload();
        });
        <script>
            $wire.on('livewire:updatedName', function(name) {
                function uncheckSpecificText(textToMatch) {
                    // Get all checkboxes within the multi-dropdown
                    let checkboxes = document.querySelectorAll('input[type="checkbox"]');

                    // Loop through each checkbox and check its corresponding label
                    checkboxes.forEach(function(checkbox) {
                        let label = checkbox.nextElementSibling;
                        if (label && label.innerText.trim() === textToMatch) {
                            checkbox.checked = false; // Uncheck the checkbox if the label text matches 'text1'
                        }
                    });
                }
                let removedName = name[0];
                uncheckSpecificText(removedName);

                console.log(removedName);
                // console.log('updated');
            });

            $wire.on('livewire:updatedClearAllFilter', function(event) {
                function uncheckAll() {
                    // Get all checkboxes within the multi-dropdown
                    let checkboxes = document.querySelectorAll('input[type="checkbox"]');
                    // Loop through each checkbox and check its corresponding label
                    checkboxes.forEach(function(checkbox) {
                        checkbox.checked = false;
                    });
                }
                uncheckAll();

                // console.log(removedName);
                // console.log('updated');
            });

            $wire.on('livewire:updatedPage', function(event) {
                const topTitleElement = document.getElementById('top-title');
                if (topTitleElement) {
                    const offset = 0; // Adjust this value as needed
                    const elementPosition = topTitleElement.getBoundingClientRect().top + window.pageYOffset;
                    const offsetPosition = elementPosition - offset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                }
                console.log('updatedPage');
                // console.log('updated');
            });
        </script>
    @endscript
</div>
