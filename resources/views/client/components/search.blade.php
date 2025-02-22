<!-- client/components/search.blade.php -->
<div class="sticky top-0 z-10 p-2 bg-white bg-gradient-to-r from-primary dark:from-primary dark:bg-gray-800 to-transparent">
    <div class="max-w-screen-xl mx-auto">
        <form class="w-full" action="{{ $actionUrl }}">
            <div class="flex flex-wrap gap-2">
                <!-- Search Database -->
                <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                    class="text-gray-900 bg-gray-100 hover:bg-gray-200 focus:outline-none font-medium rounded-tl-lg rounded-tr-lg md:rounded-s-lg text-md px-5 py-2.5 text-center inline-flex items-center w-full md:w-auto justify-center md:rounded-tr-none border border-primary dark:bg-gray-700 dark:text-gray-200 dark:border-white dark:hover:bg-gray-600"
                    type="button">
                    @if (app()->getLocale() == 'kh' && $title_kh)
                        {{ $title_kh }}
                    @else
                        {{ $title }}
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
                                    <a href="{{ url($item->slug) }}" class="menu-item-link block px-6 py-2 hover:bg-gray-100 {{ $item->name == $title ? 'underline' : '' }} dark:hover:bg-gray-600 dark:hover:text-white">
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
                        placeholder="{{ __('messages.search') }}..." name="search"/>
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
