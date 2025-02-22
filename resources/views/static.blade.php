<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RUA</title>
    <!-- Start CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/swiper.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/pdfview.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/audioplayer.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/glightbox.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/no-tailwind.css') }}" />

    <!-- <style>
        body ::selection {
            background-color: goldenrod; /* This is bg-blue-900 in Tailwind */
            color: white; /* This is text-white in Tailwind */
        }
    </style> -->

    <!-- end Start CSS -->

    <!-- Start JS -->
    <script src="{{ asset('assets/js/tailwind34.js') }}"></script>
    <script src="{{ asset('assets/js/darkModeHead.js') }}"></script>
    <script src="{{ asset('assets/js/swiper11.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script> --}}
    {{-- <script src="{{ asset('assets/js/tailwind.config.js') }}"></script> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Moul&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Siemreap&display=swap"
        rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: "class", // Enables dark mode based on class
            theme: {
                extend: {
                    colors: {
                        clifford: "#da373d",
                        primary: "#15803d",
                        warning: "#fab105",
                        warningHover: "#ffb915",
                    },
                },
                fontFamily: {
                    moul: [
                        "Moul", "Siemreap", "Arial", "Inter", "ui-sans-serif", "system-ui", "-apple-system",
                        "system-ui", "Segoe UI", "Helvetica Neue",
                    ],
                    siemreap: [
                        "Siemreap", "Arial", "Inter", "ui-sans-serif", "system-ui", "-apple-system", "system-ui",
                        "Segoe UI", "Helvetica Neue",
                    ],
                    poppins: [
                        "Poppins", "Roboto", "Arial", "Inter", "ui-sans-serif", "system-ui", "-apple-system",
                        "system-ui", "Segoe UI", "Helvetica Neue",
                    ],

                },
            },
        };
    </script>
    <script defer src="{{ asset('assets/js/alpine31.js') }}"></script>
    <script defer src="{{ asset('assets/js/darkMode.js') }}"></script>
    <script defer src="{{ asset('assets/js/flowbite23.js') }} "></script>
    <script defer src="{{ asset('assets/js/pdfPopup.js') }}"></script>
    <script defer src="{{ asset('assets/js/glightbox.js') }}"></script>
    <script defer src="{{ asset('assets/js/glightbox.config.js') }}"></script>
    <!-- End JS -->
</head>

<body class="">
    {{-- Start Header --}}
    <Header>
        <section class="max-w-screen-xl px-2 mx-auto ">
            <div class="grid items-center grid-cols-12">
                <div class="flex items-center justify-start col-span-12 p-2 lg:col-span-3 ">
                    <img src="{{ asset('/app_assets/logo.png') }}" class="object-contain w-20 rounded-md aspect-square"
                        alt="">
                    <div class="text-center">
                        <h1 class="text-sm font-moul">សាកលវិទ្យាល័យភូមិន្ទកសិកម្ម</h1>
                        <h2 class="text-sm font-poppins">Royal University of Agriculture </h2>
                    </div>
                </div>
                <div class="col-span-12 py-2 lg:col-span-9">
                    <div class="flex-col items-center w-full gap-5 md:w-auto md:flex md:order-1"
                        id="navbar-dropdown">
                        <!--Start Search-->
                        <form class="flex w-full gap-2" action="http://45.13.132.18/search">
                            <label for="voice-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 " fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input type="text" id="voice-search"
                                    class="w-full border h-full border-gray-300 text-gray-900 text-sm focus:ring-primary focus:border-primary block  pl-10 p-2.5"
                                    name="search" placeholder="Search..." required="">
                            </div>
                            <button type="submit"
                                class="inline-flex items-center py-2.5 px-3 ml-2 text-sm font-medium text-white bg-primary border border-primary hover:bg-primary focus:ring-4 focus:outline-none focus:ring-primary">
                                <svg aria-hidden="true" class="w-5 h-5 -ml-1 " fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                Search
                            </button>
                            <a href="#" type="button"
                                class=" inline-flex items-center font-medium justify-center p-2.5 text-sm text-gray-900 rounded-lg cursor-pointer hover:bg-gray-100">
                                <img class="object-cover w-8 rounded-full"
                                    src="http://45.13.132.18/public/images/khmer.png" alt="">

                            </a>
                            <a href="#" type="button"
                                class="bg-gray-200 inline-flex items-center font-medium justify-center p-2.5 text-sm text-gray-900 rounded-lg cursor-pointer hover:bg-gray-100">
                                <img class="object-cover w-8 rounded-full"
                                    src="http://45.13.132.18/public/images/english.png" alt="">
                            </a>
                            <button data-collapse-toggle="navbar-default" type="button"
                                    class="inline-flex items-center justify-center w-10 h-10 p-2 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                                    aria-controls="navbar-default" aria-expanded="false">
                                    <span class="sr-only">Open main menu</span>
                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 17 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                                    </svg>
                                </button>
                        </form>
                        <!--End Search-->


                        <nav class="hidden w-full bg-white border-gray-200 lg:block dark:bg-gray-900">
                            <div class="flex flex-wrap items-center justify-end max-w-screen-xl mx-auto">

                                <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                                    <ul
                                        class="flex justify-end">
                                        <li class="flex items-center px-2 leading-4 text-gray-700 max-w-32 hover:underline">
                                            <a href="">
                                                <p class="p-1 text-center">
                                                    Home
                                                </p>
                                            </a>
                                        </li>
                                        <li class="flex items-center px-2 leading-4 text-gray-700 max-w-32 hover:underline">
                                            <a href="">
                                                <p class="p-1 text-center">
                                                    About RUA
                                                </p>
                                            </a>
                                        </li>
                                        <li class="flex items-center px-2 leading-4 text-gray-700 max-w-32 hover:underline">
                                            <a href="">
                                                <p class="p-1 text-center">
                                                    Management
                                                </p>
                                            </a>
                                        </li>
                                        <li class="flex items-center px-2 leading-4 text-gray-700 max-w-32 hover:underline">
                                            <a href="">
                                                <p class="p-1 text-center">
                                                    Foundation
                                                </p>
                                            </a>
                                        </li>
                                        <li class="flex items-center px-2 leading-4 text-gray-700 max-w-32 hover:underline">
                                            <a href="">
                                                <p class="p-1 text-center">
                                                    Graduate Program
                                                </p>
                                            </a>
                                        </li>
                                        <li class="flex items-center px-2 leading-4 text-gray-700 max-w-32 hover:underline">
                                            <a href="">
                                                <p class="p-1 text-center">
                                                    Research and  Development Project
                                                </p>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </nav>


                    </div>
                </div>
            </div>
        </section>
        {{-- Start Bottom Navbar --}}
        <section class="hidden w-full px-2 border-gray-200 bg-primary lg:block dark:bg-gray-800">
            <nav class="max-w-screen-xl mx-auto">
                <ul class="flex justify-end">
                    <li class="flex items-center px-1 leading-4 text-white border-r border-white max-w-36 hover:bg-white hover:text-primary">
                        <a href="">
                            <p class="p-1 text-center">
                                Academic Program
                            </p>
                        </a>
                    </li>
                    <li class="flex items-center px-1 leading-4 text-white border-r border-white max-w-36 hover:bg-white hover:text-primary">
                        <a href="">
                            <p class="p-1 text-center">
                                Faculty
                            </p>
                        </a>
                    </li>
                    <li class="flex items-center px-1 leading-4 text-white border-r border-white max-w-36 hover:bg-white hover:text-primary">
                        <a href="">
                            <p class="p-1 text-center">
                                Student life
                            </p>
                        </a>
                    </li>
                    <li class="flex items-center px-1 leading-4 text-white border-r border-white max-w-36 hover:bg-white hover:text-primary">
                        <a href="">
                            <p class="p-1 text-center">
                                Industrial Linkage and Business Startup
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
        </section>
        {{-- End Bottom Navbar --}}
    </Header>
    {{-- End Header --}}
</body>

</html>
