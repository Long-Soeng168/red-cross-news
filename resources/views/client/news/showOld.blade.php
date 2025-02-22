@extends('layouts.client')

@section('content')
    @include('client.components.search')

    <!-- Detail -->
    <div class="max-w-screen-xl px-2 mx-auto mt-6 lg:px-0">
        <div class="grid grid-cols-1 lg:grid-cols-3">
            <!-- Main Content -->
            <div class="flex flex-col items-center col-span-2 px-2 mb-6 mr-2 lg-px-0">
                <div class="max-w-[100%] flex flex-col gap-2">
                    @if ($item->image)
                    <a href="{{ asset('assets/images/news/'.$item->image) }}" class="glightbox">
                        <img class="w-[100%] h-auto object-cover rounded-md cursor-pointer border"
                            src="{{ asset('assets/images/news/'.$item->image) }}" alt="Book Cover" />
                    </a>
                        <div class="grid grid-cols-4 gap-2">
                            @foreach ($multi_images as $index => $image)
                                @if ($index < 3 || count($multi_images) == 4)
                                    <a href="{{ asset('assets/images/news/' . $image->image) }}" class="glightbox">
                                        <img class="w-full aspect-[1/1] bg-white hover:scale-110 transition-transform duration-500 ease-in-out object-cover rounded-md border shadow-md"
                                            src="{{ asset('assets/images/news/thumb/' . $image->image) }}">
                                    </a>
                                @elseif ($index == 3)
                                    <a href="{{ asset('assets/images/news/' . $image->image) }}"
                                    class="glightbox relative w-full aspect-[1/1] bg-white hover:scale-110 transition-transform duration-500 ease-in-out ">
                                        <div class="absolute flex items-center justify-center w-full h-full transition-all duration-300 border rounded-md shadow-md bg-gray-900/60 hover:bg-gray-900/20">
                                            <span class="text-xl font-medium text-white">
                                                +{{ count($multi_images) - 4 }}
                                            </span>
                                        </div>
                                        <img src="{{ asset('assets/images/news/thumb/' . $image->image) }}"
                                            class="rounded-lg w-full aspect-[1/1] bg-white">
                                    </a>
                                @else
                                    <a href="{{ asset('assets/images/news/' . $image->image) }}" class="glightbox">
                                        <img class="hidden w-full aspect-[1/1] bg-white hover:scale-110 transition-transform duration-500 ease-in-out object-cover rounded-md border shadow-md"
                                            src="{{ asset('assets/images/news/thumb/' . $image->image) }}">
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    @endif

                    <!-- Action Button -->
                    <div class="flex w-full gap-2 rounded-md shadow-sm" role="group">
                        <button type="button"
                            class="inline-flex items-center justify-center flex-1 gap-2 px-4 py-1 text-sm font-medium text-gray-900 bg-transparent border border-gray-900 rounded-md hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700"
                            onclick="openPdfPopup('/files/pdf_file.pdf')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-eye">
                                <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                            <div>
                                <p class="whitespace-nowrap">Read PDF</p>
                                <p class="text-center">(54345)</p>
                            </div>
                        </button>

                        <!-- Popup Container -->
                        <div class="popup-overlay" id="popupOverlay">
                            <div class="popup-content-container">
                                <div class="popup-content">
                                    <span class="close-btn" onclick="closePdfPopup()">
                                        <img src="/icons/cancel.png" alt="" class="close-btn-image" />
                                    </span>
                                    <embed id="pdfEmbed" src="" width="100%" height="100%" />
                                </div>
                            </div>
                        </div>

                        <a href="/files/pdf_file.pdf" download
                            class="inline-flex items-center justify-center flex-1 gap-2 px-4 py-1 text-sm font-medium text-gray-900 bg-transparent border border-gray-900 rounded-md hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-arrow-down-to-line">
                                <path d="M12 17V3" />
                                <path d="m6 11 6 6 6-6" />
                                <path d="M19 21H5" />
                            </svg>
                            <div>
                                <p class="whitespace-nowrap">Download PDF</p>
                                <p class="text-center">(9567)</p>
                            </div>
                        </a>
                    </div>

                    <!-- Content Bulletin -->
                    <div>
                        <div class="text-sm font-semibold tracking-wide uppercase text-primary">
                            Bulletin
                        </div>
                        <h1 class="block mt-1 mb-2 text-2xl font-medium leading-tight text-gray-800 dark:text-gray-100">
                            Your subtitle or any other text goes here Implementation of
                            Title, Subtitle and Author name as well as any other text you
                            like to the book cover design.
                        </h1>
                        <div class="flex flex-col gap-2">
                            <div class="flex nowrap">
                                <p
                                    class="w-[123px] uppercase tracking-wide text-sm text-gray-500 dark:text-gray-300 font-semibold border-r border-gray-600 dark:border-gray-300 pr-5 mr-5">
                                    Author
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-200">
                                    Long Soeng Co.
                                </p>
                            </div>
                            <div class="flex nowrap">
                                <p
                                    class="w-[123px] uppercase tracking-wide text-sm text-gray-500 dark:text-gray-300 font-semibold border-r border-gray-600 dark:border-gray-300 pr-5 mr-5">
                                    Publisher
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-200">
                                    Routledge
                                </p>
                            </div>
                            <div class="flex nowrap">
                                <p
                                    class="w-[123px] uppercase tracking-wide text-sm text-gray-500 dark:text-gray-300 font-semibold border-r border-gray-600 dark:border-gray-300 pr-5 mr-5">
                                    Year
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-200">1988</p>
                            </div>
                            <div class="flex nowrap">
                                <p
                                    class="w-[123px] uppercase tracking-wide text-sm text-gray-500 dark:text-gray-300 font-semibold border-r border-gray-600 dark:border-gray-300 pr-5 mr-5">
                                    Page Count
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-200">322</p>
                            </div>
                            <div class="flex nowrap">
                                <p
                                    class="w-[123px] uppercase tracking-wide text-sm text-gray-500 dark:text-gray-300 font-semibold border-r border-gray-600 dark:border-gray-300 pr-5 mr-5">
                                    Type
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-200">
                                    សៀវភៅ / Book
                                </p>
                            </div>
                            <div class="flex nowrap">
                                <p
                                    class="w-[123px] uppercase tracking-wide text-sm text-gray-500 dark:text-gray-300 font-semibold border-r border-gray-600 dark:border-gray-300 pr-5 mr-5">
                                    Language
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-200">
                                    English
                                </p>
                            </div>
                            <div class="flex nowrap">
                                <p
                                    class="w-[123px] uppercase tracking-wide text-sm text-gray-500 dark:text-gray-300 font-semibold border-r border-gray-600 dark:border-gray-300 pr-5 mr-5">
                                    Location
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-200">
                                    London, England
                                </p>
                            </div>
                        </div>

                        <div class="mt-8">
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                                Description
                            </h2>
                            <p class="mt-2 text-gray-600 dark:text-gray-300">
                                Upgrade to paperback for just
                                <span class="font-bold">$100</span> extra. Get matching spine
                                and back cover for your book.
                                <a href="#" class="underline text-primary">Contact me</a> for
                                upgrading or drop in a line when you place the order.
                            </p>
                            <p class="mt-2 text-gray-600 dark:text-gray-300">
                                Purchase will include hi resolution
                                <span class="font-bold">eBook cover design</span> ready to
                                upload to Amazon Kindle, B&N Nook books and Smashwords.
                            </p>
                            <p class="mt-2 text-gray-600 dark:text-gray-300">
                                Implementation of Title, Subtitle and Author name as well as
                                any other text you like to the
                                <span class="font-bold">book cover design</span>.
                            </p>
                            <p class="mt-2 text-gray-600 dark:text-gray-300">
                                Exclusive
                                <a href="#" class="underline text-primary">premade book covers</a>, designed
                                using only Standard license royalty-free stock
                                photos. Copyrights to the design transferred to client for all
                                purchases.
                            </p>
                        </div>
                    </div>
                    <!-- End Content Bulletin -->
                </div>
            </div>
            <!-- End Main Content -->
            <!-- Items -->
            <div class="">
                <div class="flex justify-between px-2 py-1 mx-2 bg-primary xl:mx-0">
                    <p class="text-lg text-white">Related</p>
                    <a
                        class="flex items-center gap-2 text-lg text-white transition-all cursor-pointer hover:underline hover:translate-x-2">
                        See More
                        <img src="{{ asset('assets/icons/right-arrow.png') }}" alt="" class="w-5 h-5" />
                    </a>
                </div>
                <!-- Card Grid -->
                <div
                    class="grid grid-cols-2 gap-3 px-4 py-3 mx-2 border-l sm:grid-cols-2 md:grid-cols-2 xl:grid-cols-2 xl:mx-0 border-primary">
                    <!-- Card -->
                    <a class="block group" href="#">
                        <div class="w-full overflow-hidden bg-gray-100 rounded-md dark:bg-neutral-800">
                            <img class="w-full aspect-[16/9] group-hover:scale-110 transition-transform duration-500 ease-in-out object-cover rounded-md"
                                src="https://www.creativeparamita.com/wp-content/uploads/2022/03/the-mountain.jpg"
                                alt="Image Description" />
                        </div>

                        <div class="pt-2">
                            <h3 data-tooltip-target="tooltip-bottom1" data-tooltip-placement="bottom"
                                class="relative inline-block font-medium text-md text-black before:absolute before:bottom-[-0.1rem] before:start-0 before:-z-[1] before:w-full before:h-1 before:bg-lime-400 before:transition before:origin-left before:scale-x-0 group-hover:before:scale-x-100 dark:text-white">
                                <p class="line-clamp-1">ចំណងជើងខ្មែរ</p>
                            </h3>

                            <div id="tooltip-bottom1" role="tooltip"
                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                1 revamped and dynamic approach to yoga analytics A revamped
                                and dynamic approach to yoga analytics
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </div>
                    </a>

                    <a class="block group" href="#">
                        <div class="w-full overflow-hidden bg-gray-100 rounded-md dark:bg-neutral-800">
                            <img class="w-full aspect-[16/9] group-hover:scale-110 transition-transform duration-500 ease-in-out object-cover rounded-md"
                                src="https://www.creativeparamita.com/wp-content/uploads/2022/03/the-mountain.jpg"
                                alt="Image Description" />
                        </div>

                        <div class="pt-2">
                            <h3 data-tooltip-target="tooltip-bottom2" data-tooltip-placement="bottom"
                                class="relative inline-block font-medium text-md text-black before:absolute before:bottom-[-0.1rem] before:start-0 before:-z-[1] before:w-full before:h-1 before:bg-lime-400 before:transition before:origin-left before:scale-x-0 group-hover:before:scale-x-100 dark:text-white">
                                <p class="line-clamp-1">
                                    A revamped and dynamic approach to yoga analytics
                                </p>
                            </h3>

                            <div id="tooltip-bottom2" role="tooltip"
                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                2 revamped and dynamic approach to yoga analytics A revamped
                                and dynamic approach to yoga analytics
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </div>
                    </a>

                    <a class="block group" href="#">
                        <div class="w-full overflow-hidden bg-gray-100 rounded-md dark:bg-neutral-800">
                            <img class="w-full aspect-[16/9] group-hover:scale-110 transition-transform duration-500 ease-in-out object-cover rounded-md"
                                src="https://www.creativeparamita.com/wp-content/uploads/2022/03/the-mountain.jpg"
                                alt="Image Description" />
                        </div>

                        <div class="pt-2">
                            <h3 data-tooltip-target="tooltip-bottom1" data-tooltip-placement="bottom"
                                class="relative inline-block font-medium text-md text-black before:absolute before:bottom-[-0.1rem] before:start-0 before:-z-[1] before:w-full before:h-1 before:bg-lime-400 before:transition before:origin-left before:scale-x-0 group-hover:before:scale-x-100 dark:text-white">
                                <p class="line-clamp-1">ចំណងជើងខ្មែរ</p>
                            </h3>

                            <div id="tooltip-bottom1" role="tooltip"
                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                1 revamped and dynamic approach to yoga analytics A revamped
                                and dynamic approach to yoga analytics
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </div>
                    </a>

                    <a class="block group" href="#">
                        <div class="w-full overflow-hidden bg-gray-100 rounded-md dark:bg-neutral-800">
                            <img class="w-full aspect-[16/9] group-hover:scale-110 transition-transform duration-500 ease-in-out object-cover rounded-md"
                                src="https://www.creativeparamita.com/wp-content/uploads/2022/03/the-mountain.jpg"
                                alt="Image Description" />
                        </div>

                        <div class="pt-2">
                            <h3 data-tooltip-target="tooltip-bottom2" data-tooltip-placement="bottom"
                                class="relative inline-block font-medium text-md text-black before:absolute before:bottom-[-0.1rem] before:start-0 before:-z-[1] before:w-full before:h-1 before:bg-lime-400 before:transition before:origin-left before:scale-x-0 group-hover:before:scale-x-100 dark:text-white">
                                <p class="line-clamp-1">
                                    A revamped and dynamic approach to yoga analytics
                                </p>
                            </h3>

                            <div id="tooltip-bottom2" role="tooltip"
                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                2 revamped and dynamic approach to yoga analytics A revamped
                                and dynamic approach to yoga analytics
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </div>
                    </a>

                    <a class="block group" href="#">
                        <div class="w-full overflow-hidden bg-gray-100 rounded-md dark:bg-neutral-800">
                            <img class="w-full aspect-[16/9] group-hover:scale-110 transition-transform duration-500 ease-in-out object-cover rounded-md"
                                src="https://www.creativeparamita.com/wp-content/uploads/2022/03/the-mountain.jpg"
                                alt="Image Description" />
                        </div>

                        <div class="pt-2">
                            <h3 data-tooltip-target="tooltip-bottom1" data-tooltip-placement="bottom"
                                class="relative inline-block font-medium text-md text-black before:absolute before:bottom-[-0.1rem] before:start-0 before:-z-[1] before:w-full before:h-1 before:bg-lime-400 before:transition before:origin-left before:scale-x-0 group-hover:before:scale-x-100 dark:text-white">
                                <p class="line-clamp-1">ចំណងជើងខ្មែរ</p>
                            </h3>

                            <div id="tooltip-bottom1" role="tooltip"
                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                1 revamped and dynamic approach to yoga analytics A revamped
                                and dynamic approach to yoga analytics
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </div>
                    </a>

                    <a class="block group" href="#">
                        <div class="w-full overflow-hidden bg-gray-100 rounded-md dark:bg-neutral-800">
                            <img class="w-full aspect-[16/9] group-hover:scale-110 transition-transform duration-500 ease-in-out object-cover rounded-md"
                                src="https://www.creativeparamita.com/wp-content/uploads/2022/03/the-mountain.jpg"
                                alt="Image Description" />
                        </div>

                        <div class="pt-2">
                            <h3 data-tooltip-target="tooltip-bottom2" data-tooltip-placement="bottom"
                                class="relative inline-block font-medium text-md text-black before:absolute before:bottom-[-0.1rem] before:start-0 before:-z-[1] before:w-full before:h-1 before:bg-lime-400 before:transition before:origin-left before:scale-x-0 group-hover:before:scale-x-100 dark:text-white">
                                <p class="line-clamp-1">
                                    A revamped and dynamic approach to yoga analytics
                                </p>
                            </h3>

                            <div id="tooltip-bottom2" role="tooltip"
                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                2 revamped and dynamic approach to yoga analytics A revamped
                                and dynamic approach to yoga analytics
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </div>
                    </a>

                    <a class="block group" href="#">
                        <div class="w-full overflow-hidden bg-gray-100 rounded-md dark:bg-neutral-800">
                            <img class="w-full aspect-[16/9] group-hover:scale-110 transition-transform duration-500 ease-in-out object-cover rounded-md"
                                src="https://www.creativeparamita.com/wp-content/uploads/2022/03/the-mountain.jpg"
                                alt="Image Description" />
                        </div>

                        <div class="pt-2">
                            <h3 data-tooltip-target="tooltip-bottom1" data-tooltip-placement="bottom"
                                class="relative inline-block font-medium text-md text-black before:absolute before:bottom-[-0.1rem] before:start-0 before:-z-[1] before:w-full before:h-1 before:bg-lime-400 before:transition before:origin-left before:scale-x-0 group-hover:before:scale-x-100 dark:text-white">
                                <p class="line-clamp-1">ចំណងជើងខ្មែរ</p>
                            </h3>

                            <div id="tooltip-bottom1" role="tooltip"
                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                1 revamped and dynamic approach to yoga analytics A revamped
                                and dynamic approach to yoga analytics
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </div>
                    </a>

                    <a class="block group" href="#">
                        <div class="w-full overflow-hidden bg-gray-100 rounded-md dark:bg-neutral-800">
                            <img class="w-full aspect-[16/9] group-hover:scale-110 transition-transform duration-500 ease-in-out object-cover rounded-md"
                                src="https://www.creativeparamita.com/wp-content/uploads/2022/03/the-mountain.jpg"
                                alt="Image Description" />
                        </div>

                        <div class="pt-2">
                            <h3 data-tooltip-target="tooltip-bottom2" data-tooltip-placement="bottom"
                                class="relative inline-block font-medium text-md text-black before:absolute before:bottom-[-0.1rem] before:start-0 before:-z-[1] before:w-full before:h-1 before:bg-lime-400 before:transition before:origin-left before:scale-x-0 group-hover:before:scale-x-100 dark:text-white">
                                <p class="line-clamp-1">
                                    A revamped and dynamic approach to yoga analytics
                                </p>
                            </h3>

                            <div id="tooltip-bottom2" role="tooltip"
                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                2 revamped and dynamic approach to yoga analytics A revamped
                                and dynamic approach to yoga analytics
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </div>
                    </a>

                    <a class="block group" href="#">
                        <div class="w-full overflow-hidden bg-gray-100 rounded-md dark:bg-neutral-800">
                            <img class="w-full aspect-[16/9] group-hover:scale-110 transition-transform duration-500 ease-in-out object-cover rounded-md"
                                src="https://www.creativeparamita.com/wp-content/uploads/2022/03/the-mountain.jpg"
                                alt="Image Description" />
                        </div>

                        <div class="pt-2">
                            <h3 data-tooltip-target="tooltip-bottom1" data-tooltip-placement="bottom"
                                class="relative inline-block font-medium text-md text-black before:absolute before:bottom-[-0.1rem] before:start-0 before:-z-[1] before:w-full before:h-1 before:bg-lime-400 before:transition before:origin-left before:scale-x-0 group-hover:before:scale-x-100 dark:text-white">
                                <p class="line-clamp-1">ចំណងជើងខ្មែរ</p>
                            </h3>

                            <div id="tooltip-bottom1" role="tooltip"
                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                1 revamped and dynamic approach to yoga analytics A revamped
                                and dynamic approach to yoga analytics
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </div>
                    </a>

                    <a class="block group" href="#">
                        <div class="w-full overflow-hidden bg-gray-100 rounded-md dark:bg-neutral-800">
                            <img class="w-full aspect-[16/9] group-hover:scale-110 transition-transform duration-500 ease-in-out object-cover rounded-md"
                                src="https://www.creativeparamita.com/wp-content/uploads/2022/03/the-mountain.jpg"
                                alt="Image Description" />
                        </div>

                        <div class="pt-2">
                            <h3 data-tooltip-target="tooltip-bottom2" data-tooltip-placement="bottom"
                                class="relative inline-block font-medium text-md text-black before:absolute before:bottom-[-0.1rem] before:start-0 before:-z-[1] before:w-full before:h-1 before:bg-lime-400 before:transition before:origin-left before:scale-x-0 group-hover:before:scale-x-100 dark:text-white">
                                <p class="line-clamp-1">
                                    A revamped and dynamic approach to yoga analytics
                                </p>
                            </h3>

                            <div id="tooltip-bottom2" role="tooltip"
                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                2 revamped and dynamic approach to yoga analytics A revamped
                                and dynamic approach to yoga analytics
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </div>
                    </a>

                    <a class="block group" href="#">
                        <div class="w-full overflow-hidden bg-gray-100 rounded-md dark:bg-neutral-800">
                            <img class="w-full aspect-[16/9] group-hover:scale-110 transition-transform duration-500 ease-in-out object-cover rounded-md"
                                src="https://www.creativeparamita.com/wp-content/uploads/2022/03/the-mountain.jpg"
                                alt="Image Description" />
                        </div>

                        <div class="pt-2">
                            <h3 data-tooltip-target="tooltip-bottom1" data-tooltip-placement="bottom"
                                class="relative inline-block font-medium text-md text-black before:absolute before:bottom-[-0.1rem] before:start-0 before:-z-[1] before:w-full before:h-1 before:bg-lime-400 before:transition before:origin-left before:scale-x-0 group-hover:before:scale-x-100 dark:text-white">
                                <p class="line-clamp-1">ចំណងជើងខ្មែរ</p>
                            </h3>

                            <div id="tooltip-bottom1" role="tooltip"
                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                1 revamped and dynamic approach to yoga analytics A revamped
                                and dynamic approach to yoga analytics
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </div>
                    </a>

                    <a class="block group" href="#">
                        <div class="w-full overflow-hidden bg-gray-100 rounded-md dark:bg-neutral-800">
                            <img class="w-full aspect-[16/9] group-hover:scale-110 transition-transform duration-500 ease-in-out object-cover rounded-md"
                                src="https://www.creativeparamita.com/wp-content/uploads/2022/03/the-mountain.jpg"
                                alt="Image Description" />
                        </div>

                        <div class="pt-2">
                            <h3 data-tooltip-target="tooltip-bottom2" data-tooltip-placement="bottom"
                                class="relative inline-block font-medium text-md text-black before:absolute before:bottom-[-0.1rem] before:start-0 before:-z-[1] before:w-full before:h-1 before:bg-lime-400 before:transition before:origin-left before:scale-x-0 group-hover:before:scale-x-100 dark:text-white">
                                <p class="line-clamp-1">
                                    A revamped and dynamic approach to yoga analytics
                                </p>
                            </h3>

                            <div id="tooltip-bottom2" role="tooltip"
                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-600 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                2 revamped and dynamic approach to yoga analytics A revamped
                                and dynamic approach to yoga analytics
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- End Card Grid -->
            </div>
            <!-- End Items -->
        </div>
    </div>
    <!-- End Detail -->
@endsection
