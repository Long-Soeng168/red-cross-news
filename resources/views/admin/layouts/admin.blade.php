<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>One Digital Library</title>

    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    {{-- Initailize Plugin --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Moul&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Siemreap&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/select2.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/js/tailwindcss3.4.js') }}"></script>
    <script src="{{ asset('assets/js/tailwindConfig.js') }}"></script>
    <script src="{{ asset('assets/js/darkModeHead.js') }}"></script>
    <script defer src="{{ asset('assets/js/darkMode.js') }}"></script>

    <script defer src="{{ asset('assets/js/select2.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('/assets/css/no-tailwind.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/glightbox.css') }}">

    <script defer src="{{ asset('assets/js/alpine31.js') }}"></script>

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="{{ $websiteInfo->name }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/website_infos/logo.png') }}">
    <link rel="apple-touch-startup-image" href="{{ asset('assets/images/website_infos/logo.png') }}">
    <link rel="icon" href="{{ asset('assets/images/website_infos/logo.png') }}">

    <style>
        .select2-selection {
            height: 100% !important;
            display: flex !important;
            flex-direction: column !important;
            justify-content: center !important;
            background-color: #f9fafb !important;
            border-color: #d1d5db !important;
            flex: 1 !important;
        }

        .dark .select2-selection__rendered {
            color: white !important;
        }

        .dark .select2-selection {
            height: 100% !important;
            display: flex !important;
            flex-direction: column !important;
            justify-content: center !important;
            background-color: #374151 !important;
            border-color: #49505b !important;
            flex: 1 !important;
        }

        .select2-selection__arrow {
            height: 100% !important;
        }

        .select2-selection__choice {
            background-color: #c5d5ff !important;
            border-color: #0d43d6 !important;
            color: #000000 !important;
        }

        .select2-selection__choice__remove {
            color: black !important;
        }
    </style>

    {{-- Start Scroll Bar Style --}}
    <style>
    /* ===== Scrollbar CSS ===== */
    /* Firefox */
    * {
        scrollbar-width: auto;
        /* scrollbar-color: #377EB4 #ffffff; */
        scrollbar-color: {{ $websiteInfo->primary }} #ffffff;
    }

    /* Chrome, Edge, and Safari */
    *::-webkit-scrollbar {
        width: 16px;
    }

    *::-webkit-scrollbar-track {
        background: #ffffff;
    }

    *::-webkit-scrollbar-thumb {
        background-color: #8f54a0;
        border-radius: 10px;
        border: 3px solid #ffffff;
    }
    </style>

    {{-- Show popup to reload screen when resize --}}
    {{-- <script>
        // Function to show the modal
        function showReloadModal() {
            document.getElementById('reloadModal').classList.remove('hidden');
        }

        // Function to hide the modal
        function hideReloadModal() {
            document.getElementById('reloadModal').classList.add('hidden');
        }

        // Function to reload the page
        function reloadPage() {
            window.location.reload();
        }

        // Check if the window has been resized
        window.addEventListener('resize', function() {
            showReloadModal(); // Show modal when window is resized
        });
    </script> --}}
    <script>
        // Function to show the modal
        function showReloadModal() {
            document.getElementById('reloadModal').classList.remove('hidden');
        }

        // Function to hide the modal
        function hideReloadModal() {
            document.getElementById('reloadModal').classList.add('hidden');
        }

        // Function to reload the page
        function reloadPage() {
            window.location.reload();
        }

        // Variables to store the initial window size
        let initialWidth = window.innerWidth;
        let initialHeight = window.innerHeight;

        // Check if the window has been resized by at least 100 pixels
        window.addEventListener('resize', function() {
            let newWidth = window.innerWidth;
            let newHeight = window.innerHeight;

            // Calculate the difference in size
            let widthDifference = Math.abs(newWidth - initialWidth);
            let heightDifference = Math.abs(newHeight - initialHeight);

            // Show modal if the difference is at least 100 pixels
            if (widthDifference >= 100 || heightDifference >= 100) {
                showReloadModal();
            }
        });
    </script>


</head>

<body class="min-h-[100vh] font-body">
    <!-- Modal Reload Page -->
    <div id="reloadModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-gray-800 bg-opacity-75">
        <div class="max-w-md p-8 bg-white rounded shadow-lg">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold">Screen Resize Detected</h2>
                <button class="text-gray-600 hover:text-gray-800" onclick="hideReloadModal()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <p class="mb-4 text-sm text-gray-700">Your screen has been resized. For optimal experience, please reload
                the page.</p>
            <div class="flex justify-end">
                <button class="px-4 py-2 mr-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-300"
                    onclick="hideReloadModal()">Close</button>
                <button class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600" onclick="reloadPage()">Reload
                    Page</button>
            </div>
        </div>
    </div>

    <div class="antialiased min-h-[100vh] bg-gray-50 dark:bg-gray-800">
        <nav
            class="border-b border-gray-200 px-4 py-2.5 bg-white dark:bg-gray-800 dark:border-gray-700 fixed left-0 right-0 top-0 z-30">
            <div class="flex flex-wrap items-center justify-between">
                <div class="flex items-center justify-start">
                    <button data-drawer-target="drawer-navigation" data-drawer-toggle="drawer-navigation"
                        aria-controls="drawer-navigation"
                        class="p-2 mr-2 text-gray-600 rounded-lg cursor-pointer md:hidden hover:text-gray-900 hover:bg-gray-100 focus:bg-gray-100 dark:focus:bg-gray-700 focus:ring-2 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <svg aria-hidden="true" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Toggle sidebar</span>
                    </button>
                    <a href="/" class="flex items-center justify-center mr-4">
                        @if ($websiteInfo->image)
                            <img src="{{ asset('assets/images/website_infos/logo192.png') }}"
                                class="h-8 mr-3" alt="Flowbite Logo" />
                        @endif
                        <span
                            class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">{{ $websiteInfo->name }}</span>
                    </a>

                </div>
                <div class="flex items-center lg:order-2">
                    <button type="button" data-drawer-toggle="drawer-navigation" aria-controls="drawer-navigation"
                        class="p-2 mr-1 text-gray-500 rounded-lg md:hidden hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600">
                        <span class="sr-only">Toggle search</span>
                        <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z">
                            </path>
                        </svg>
                    </button>
                    {{-- <!-- Notifications -->
                    <button type="button" data-dropdown-toggle="notification-dropdown"
                        class="p-2 mr-1 text-gray-500 rounded-lg hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600">
                        <span class="sr-only">View notifications</span>
                        <!-- Bell icon -->
                        <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z">
                            </path>
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div class="z-50 hidden max-w-sm my-4 overflow-hidden text-base list-none bg-white divide-y divide-gray-100 rounded shadow-lg dark:divide-gray-600 dark:bg-gray-700 rounded-xl"
                        id="notification-dropdown">
                        <div
                            class="block px-4 py-2 text-base font-medium text-center text-gray-700 bg-gray-50 dark:bg-gray-600 dark:text-gray-300">
                            Notifications
                        </div>
                        <div>
                            <a href="#"
                                class="flex px-4 py-3 border-b hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">
                                <div class="flex-shrink-0">
                                    <img class="rounded-full w-11 h-11"
                                        src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/bonnie-green.png"
                                        alt="Bonnie Green avatar" />
                                    <div
                                        class="absolute flex items-center justify-center w-5 h-5 ml-6 -mt-5 border border-white rounded-full bg-primary-700 dark:border-gray-700">
                                        <svg aria-hidden="true" class="w-3 h-3 text-white" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z">
                                            </path>
                                            <path
                                                d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="w-full pl-3">
                                    <div class="text-gray-500 font-normal text-sm mb-1.5 dark:text-gray-400">
                                        New message from
                                        <span class="font-semibold text-gray-900 dark:text-white">Bonnie Green</span>:
                                        "Hey, what's up? All set for the presentation?"
                                    </div>
                                    <div class="text-xs font-medium text-primary-600 dark:text-primary-500">
                                        a few moments ago
                                    </div>
                                </div>
                            </a>
                            <a href="#"
                                class="flex px-4 py-3 border-b hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">
                                <div class="flex-shrink-0">
                                    <img class="rounded-full w-11 h-11"
                                        src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/jese-leos.png"
                                        alt="Jese Leos avatar" />
                                    <div
                                        class="absolute flex items-center justify-center w-5 h-5 ml-6 -mt-5 bg-gray-900 border border-white rounded-full dark:border-gray-700">
                                        <svg aria-hidden="true" class="w-3 h-3 text-white" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="w-full pl-3">
                                    <div class="text-gray-500 font-normal text-sm mb-1.5 dark:text-gray-400">
                                        <span class="font-semibold text-gray-900 dark:text-white">Jese leos</span>
                                        and
                                        <span class="font-medium text-gray-900 dark:text-white">5 others</span>
                                        started following you.
                                    </div>
                                    <div class="text-xs font-medium text-primary-600 dark:text-primary-500">
                                        10 minutes ago
                                    </div>
                                </div>
                            </a>
                            <a href="#"
                                class="flex px-4 py-3 border-b hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">
                                <div class="flex-shrink-0">
                                    <img class="rounded-full w-11 h-11"
                                        src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/joseph-mcfall.png"
                                        alt="Joseph McFall avatar" />
                                    <div
                                        class="absolute flex items-center justify-center w-5 h-5 ml-6 -mt-5 bg-red-600 border border-white rounded-full dark:border-gray-700">
                                        <svg aria-hidden="true" class="w-3 h-3 text-white" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="w-full pl-3">
                                    <div class="text-gray-500 font-normal text-sm mb-1.5 dark:text-gray-400">
                                        <span class="font-semibold text-gray-900 dark:text-white">Joseph Mcfall</span>
                                        and
                                        <span class="font-medium text-gray-900 dark:text-white">141 others</span>
                                        love your story. See it and view more stories.
                                    </div>
                                    <div class="text-xs font-medium text-primary-600 dark:text-primary-500">
                                        44 minutes ago
                                    </div>
                                </div>
                            </a>
                            <a href="#"
                                class="flex px-4 py-3 border-b hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">
                                <div class="flex-shrink-0">
                                    <img class="rounded-full w-11 h-11"
                                        src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/roberta-casas.png"
                                        alt="Roberta Casas image" />
                                    <div
                                        class="absolute flex items-center justify-center w-5 h-5 ml-6 -mt-5 bg-green-400 border border-white rounded-full dark:border-gray-700">
                                        <svg aria-hidden="true" class="w-3 h-3 text-white" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h3a1 1 0 100-2H6z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="w-full pl-3">
                                    <div class="text-gray-500 font-normal text-sm mb-1.5 dark:text-gray-400">
                                        <span class="font-semibold text-gray-900 dark:text-white">Leslie
                                            Livingston</span>
                                        mentioned you in a comment:
                                        <span
                                            class="font-medium text-primary-600 dark:text-primary-500">@bonnie.green</span>
                                        what do you say?
                                    </div>
                                    <div class="text-xs font-medium text-primary-600 dark:text-primary-500">
                                        1 hour ago
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-600">
                                <div class="flex-shrink-0">
                                    <img class="rounded-full w-11 h-11"
                                        src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/robert-brown.png"
                                        alt="Robert image" />
                                    <div
                                        class="absolute flex items-center justify-center w-5 h-5 ml-6 -mt-5 bg-purple-500 border border-white rounded-full dark:border-gray-700">
                                        <svg aria-hidden="true" class="w-3 h-3 text-white" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="w-full pl-3">
                                    <div class="text-gray-500 font-normal text-sm mb-1.5 dark:text-gray-400">
                                        <span class="font-semibold text-gray-900 dark:text-white">Robert Brown</span>
                                        posted a new video: Glassmorphism - learn how to implement
                                        the new design trend.
                                    </div>
                                    <div class="text-xs font-medium text-primary-600 dark:text-primary-500">
                                        3 hours ago
                                    </div>
                                </div>
                            </a>
                        </div>
                        <a href="#"
                            class="block py-2 font-medium text-center text-gray-900 text-md bg-gray-50 hover:bg-gray-100 dark:bg-gray-600 dark:text-white dark:hover:underline">
                            <div class="inline-flex items-center">
                                <svg aria-hidden="true" class="w-4 h-4 mr-2 text-gray-500 dark:text-gray-400"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                    <path fill-rule="evenodd"
                                        d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                View all
                            </div>
                        </a>
                    </div> --}}
                    <!-- Apps -->
                    <button type="button" data-dropdown-toggle="apps-dropdown"
                        class="p-2 text-gray-500 rounded-lg hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600">
                        <span class="sr-only">View notifications</span>
                        <!-- Icon -->
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                            </path>
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div class="z-50 hidden max-w-sm my-4 overflow-hidden text-base list-none bg-white divide-y divide-gray-100 rounded shadow-lg dark:bg-gray-700 dark:divide-gray-600 rounded-xl"
                        id="apps-dropdown">
                        <div
                            class="block px-4 py-2 text-base font-medium text-center text-gray-700 bg-gray-50 dark:bg-gray-600 dark:text-gray-300">
                            Apps
                        </div>
                        <div class="grid grid-cols-3 gap-4 p-4">
                            <a href="{{ url('admin/dashboard') }}"
                                class="{{ request()->is('admin/dashboard*') ? 'bg-slate-200 dark:bg-slate-500' : '' }} flex flex-col items-center justify-center p-4 text-center rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 group">
                                <img src="{{ asset('assets/icons/dashboard.png') }}" alt="icon"
                                    class="object-contain w-8 h-8 p-0.5 bg-white dark:bg-gray-200 rounded">
                                <div class="text-sm text-gray-900 dark:text-white">Dashboard</div>
                            </a>
                            <a href="{{ url('admin/users') }}"
                                class="{{ request()->is('admin/users*') ? 'bg-slate-200 dark:bg-slate-500' : '' }} flex flex-col items-center justify-center p-4 text-center rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 group">
                                <img src="{{ asset('assets/icons/user.png') }}" alt="icon"
                                    class="object-contain w-8 h-8 p-0.5 bg-white dark:bg-gray-200 rounded">
                                <div class="text-sm text-gray-900 dark:text-white">Users</div>
                            </a>
                            @forelse ($menu_databases as $database)
                                @if ($database->type !== 'slug')
                                    @continue
                                @endif
                                @switch($database->slug)
                                    @case('publications')
                                        @can('view epublication')
                                            <a href="{{ url('admin/publications') }}"
                                                class="{{ request()->is('admin/publications*') ? 'bg-slate-200 dark:bg-slate-500' : '' }} flex flex-col items-center justify-center p-4 text-center rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 group">
                                                <img src="{{ asset('assets/images/databases/' . $database->image) }}" alt="icon"
                                                    class="object-contain h-8 aspect-square p-0.5 bg-white dark:bg-gray-200 rounded">
                                                <div class="text-sm text-gray-900 dark:text-white">Publications</div>
                                            </a>
                                        @endcan
                                    @break

                                    @case('videos')
                                        @can('view video')
                                        <a href="{{ url('admin/videos') }}"
                                            class="{{ request()->is('admin/videos*') ? 'bg-slate-200 dark:bg-slate-500' : '' }} flex flex-col items-center justify-center p-4 text-center rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 group">
                                            <img src="{{ asset('assets/images/databases/' . $database->image) }}" alt="icon"
                                                class="object-contain h-8 aspect-square p-0.5 bg-white dark:bg-gray-200 rounded">
                                            <div class="text-sm text-gray-900 dark:text-white">Videos</div>
                                        </a>
                                        @endcan
                                    @break

                                    @case('images')
                                        @can('view image')
                                        <a href="{{ url('admin/images') }}"
                                            class="{{ request()->is('admin/images*') ? 'bg-slate-200 dark:bg-slate-500' : '' }} flex flex-col items-center justify-center p-4 text-center rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 group">
                                            <img src="{{ asset('assets/images/databases/' . $database->image) }}" alt="icon"
                                                class="object-contain h-8 aspect-square p-0.5 bg-white dark:bg-gray-200 rounded">
                                            <div class="text-sm text-gray-900 dark:text-white">Images</div>
                                        </a>
                                        @endcan
                                    @break

                                    @case('audios')
                                        @can('view audio')
                                        <a href="{{ url('admin/audios') }}"
                                            class="{{ request()->is('admin/audios*') ? 'bg-slate-200 dark:bg-slate-500' : '' }} flex flex-col items-center justify-center p-4 text-center rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 group">
                                            <img src="{{ asset('assets/images/databases/' . $database->image) }}" alt="icon"
                                                class="object-contain h-8 aspect-square p-0.5 bg-white dark:bg-gray-200 rounded">
                                            <div class="text-sm text-gray-900 dark:text-white">Audios</div>
                                        </a>
                                        @endcan
                                    @break

                                    @case('bulletins')
                                        @can('view bulletin')
                                        <a href="{{ url('admin/bulletins') }}"
                                            class="{{ request()->is('admin/bulletins*') ? 'bg-slate-200 dark:bg-slate-500' : '' }} flex flex-col items-center justify-center p-4 text-center rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 group">
                                            <img src="{{ asset('assets/images/databases/' . $database->image) }}" alt="icon"
                                                class="object-contain h-8 aspect-square p-0.5 bg-white dark:bg-gray-200 rounded">
                                            <div class="text-sm text-gray-900 dark:text-white">Bulletins</div>
                                        </a>
                                        @endcan
                                    @break

                                    @case('theses')
                                        @can('view thesis')
                                        <a href="{{ url('admin/theses') }}"
                                            class="{{ request()->is('admin/theses*') ? 'bg-slate-200 dark:bg-slate-500' : '' }} flex flex-col items-center justify-center p-4 text-center rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 group">
                                            <img src="{{ asset('assets/images/databases/' . $database->image) }}" alt="icon"
                                                class="object-contain h-8 aspect-square p-0.5 bg-white dark:bg-gray-200 rounded">
                                            <div class="text-sm text-gray-900 dark:text-white">Theses</div>
                                        </a>
                                        @endcan
                                    @break

                                    @case('journals')
                                        @can('view journal')
                                        <a href="{{ url('admin/journals') }}"
                                            class="{{ request()->is('admin/journals*') ? 'bg-slate-200 dark:bg-slate-500' : '' }} flex flex-col items-center justify-center p-4 text-center rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 group">
                                            <img src="{{ asset('assets/images/databases/' . $database->image) }}" alt="icon"
                                                class="object-contain h-8 aspect-square p-0.5 bg-white dark:bg-gray-200 rounded">
                                            <div class="text-sm text-gray-900 dark:text-white">Journals</div>
                                        </a>
                                        @endcan
                                    @break

                                    @case('articles')
                                        @can('view article')
                                        <a href="{{ url('admin/articles') }}"
                                            class="{{ request()->is('admin/articles*') ? 'bg-slate-200 dark:bg-slate-500' : '' }} flex flex-col items-center justify-center p-4 text-center rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 group">
                                            <img src="{{ asset('assets/images/databases/' . $database->image) }}" alt="icon"
                                                class="object-contain h-8 aspect-square p-0.5 bg-white dark:bg-gray-200 rounded">
                                            <div class="text-sm text-gray-900 dark:text-white">Articles</div>
                                        </a>
                                        @endcan
                                    @break
                                @endswitch
                                @empty
                                @endforelse

                            </div>
                        </div>
                        <button type="button"
                            class="flex mx-3 text-sm bg-white rounded-full dark:bg-gray-300 md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                            id="user-menu-button" aria-expanded="false" data-dropdown-toggle="dropdown">
                            <span class="sr-only">Open user menu</span>
                            @if (auth()->user()->image)
                                <img class="object-cover w-8 h-8 p-0.5 rounded-full"
                                    src="{{ asset('assets/images/users/thumb/' . auth()->user()->image) }}"
                                    alt="user photo" />
                            @else
                                <img class="object-cover w-8 h-8 p-0.5 rounded-full"
                                    src="{{ asset('assets/icons/profile.png') }}" alt="user photo" />
                            @endif

                        </button>
                        <!-- Dropdown menu -->
                        <div class="z-50 hidden w-56 my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600 rounded-xl"
                            id="dropdown">
                            <div class="px-4 py-3">
                                <span class="block text-sm font-semibold text-gray-900 dark:text-white">
                                    {{ auth()->user()->name }}
                                </span>
                                <span class="block text-sm text-gray-900 truncate dark:text-white">
                                    {{ auth()->user()->email }}
                                </span>
                            </div>
                            <ul class="py-1 text-gray-700 dark:text-gray-300" aria-labelledby="dropdown">
                                <li>
                                    <a href="#profileFrame" data-gallery="gallery2"
                                        class="block px-4 py-2 text-sm glightbox4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">
                                        My Profile
                                    </a>
                                    <div id="profileFrame" class="hidden dark:bg-gray-800">
                                        <div class="max-w-screen-xl px-2 mx-auto mt-6 lg:px-0">
                                            <div class="min-[1000px]:flex">
                                                <div class="flex flex-col items-center mb-6">
                                                    <div
                                                        class="max-w-[400px] w-full lg:w-auto flex flex-col gap-2 px-2 lg:px-0 border rounded-lg overflow-hidden shardow-md">
                                                        @if (auth()->user()->image)
                                                            <img class="max-w-[400px] h-auto aspect-square object-cover rounded-md cursor-pointer"
                                                                src="{{ asset('assets/images/users/thumb/' . auth()->user()->image) }}"
                                                                alt="User photo">
                                                        @else
                                                            <img class="max-w-[400px] h-auto aspect-square object-cover rounded-md cursor-pointer"
                                                                src="{{ asset('assets/icons/profile.png') }}"
                                                                alt="User photo">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="lg:ml-4">
                                                    <div
                                                        class="mb-4 text-sm font-semibold tracking-wide text-blue-600 uppercase">
                                                        User Informations
                                                    </div>
                                                    {{-- <h1 class="block mt-1 mb-2 text-2xl font-medium leading-tight text-gray-800 dark:text-gray-100">
                                                    Your subtitle or any other text goes here Implementation of Title,
                                                    Subtitle and Author name as well as any other text you like to the
                                                    book cover design.
                                                </h1> --}}
                                                    <div class="flex flex-col gap-2">
                                                        <div class="flex nowrap">
                                                            <p
                                                                class="w-[123px] uppercase tracking-wide text-sm text-gray-500 dark:text-gray-300 font-semibold border-r border-gray-600 dark:border-gray-300 pr-5 mr-5">
                                                                Name
                                                            </p>
                                                            <p class="text-sm text-gray-600 dark:text-gray-200">
                                                                {{ auth()->user()->name }}
                                                            </p>
                                                        </div>
                                                        <div class="flex nowrap">
                                                            <p
                                                                class="w-[123px] uppercase tracking-wide text-sm text-gray-500 dark:text-gray-300 font-semibold border-r border-gray-600 dark:border-gray-300 pr-5 mr-5">
                                                                gender
                                                            </p>
                                                            <p class="text-sm text-gray-600 dark:text-gray-200">
                                                                {{ auth()->user()->gender ? auth()->user()->gender : 'N/A' }}
                                                            </p>
                                                        </div>
                                                        <div class="flex nowrap">
                                                            <p
                                                                class="w-[123px] uppercase tracking-wide text-sm text-gray-500 dark:text-gray-300 font-semibold border-r border-gray-600 dark:border-gray-300 pr-5 mr-5">
                                                                Phone
                                                            </p>
                                                            <p class="text-sm text-gray-600 dark:text-gray-200">
                                                                {{ auth()->user()->phone ? auth()->user()->phone : 'N/A' }}
                                                            </p>
                                                        </div>
                                                        <div class="flex nowrap">
                                                            <p
                                                                class="w-[123px] uppercase tracking-wide text-sm text-gray-500 dark:text-gray-300 font-semibold border-r border-gray-600 dark:border-gray-300 pr-5 mr-5">
                                                                Email
                                                            </p>
                                                            <p class="text-sm text-gray-600 dark:text-gray-200">
                                                                {{ auth()->user()->email ? auth()->user()->email : 'N/A' }}
                                                            </p>
                                                        </div>
                                                        <div class="flex nowrap">
                                                            <p
                                                                class="w-[123px] uppercase tracking-wide text-sm text-gray-500 dark:text-gray-300 font-semibold border-r border-gray-600 dark:border-gray-300 pr-5 mr-5">
                                                                Birth Date
                                                            </p>
                                                            <p class="text-sm text-gray-600 dark:text-gray-200">
                                                                {{ auth()->user()->date_of_birth ? auth()->user()->date_of_birth : 'N/A' }}
                                                            </p>
                                                        </div>
                                                        <div class="flex nowrap">
                                                            <p
                                                                class="w-[123px] uppercase tracking-wide text-sm text-gray-500 dark:text-gray-300 font-semibold border-r border-gray-600 dark:border-gray-300 pr-5 mr-5">
                                                                Address
                                                            </p>
                                                            <p class="text-sm text-gray-600 dark:text-gray-200">
                                                                {{ auth()->user()->address ? auth()->user()->address : 'N/A' }}
                                                            </p>
                                                        </div>
                                                        <div class="flex nowrap">
                                                            <p
                                                                class="w-[123px] uppercase tracking-wide text-sm text-gray-500 dark:text-gray-300 font-semibold border-r border-gray-600 dark:border-gray-300 pr-5 mr-5">
                                                                Roles
                                                            </p>
                                                            <p
                                                                class="flex flex-wrap gap-1.5 text-sm text-gray-600 uppercase dark:text-gray-600">
                                                                @forelse (auth()->user()->roles as $role)
                                                                    <span class="bg-blue-200 ">{{ $role->name }}</span>
                                                                @empty
                                                                    <span>N/A</span>
                                                                @endforelse
                                                            </p>
                                                        </div>
                                                        <div class="flex nowrap">
                                                            <p class="w-[123px] uppercase tracking-wide text-sm text-gray-500 dark:text-gray-300 font-semibold border-r border-gray-600 dark:border-gray-300 pr-5 mr-5">
                                                                Start-Expire
                                                            </p>
                                                            <p class="text-sm text-gray-600 dark:text-gray-200">
                                                                {{ auth()->user()->expired_at ? auth()->user()->started_at.' => '.auth()->user()->expired_at : 'No Expire' }}
                                                            </p>
                                                        </div>
                                                        <div class="flex nowrap">
                                                            <p
                                                                class="w-[123px] uppercase tracking-wide text-sm text-gray-500 dark:text-gray-300 font-semibold border-r border-gray-600 dark:border-gray-300 pr-5 mr-5">
                                                                Created At
                                                            </p>
                                                            <p class="text-sm text-gray-600 dark:text-gray-200">
                                                                {{ auth()->user()->created_at ? auth()->user()->created_at : 'N/A' }}
                                                            </p>
                                                        </div>
                                                        <div class="flex nowrap">
                                                            <p
                                                                class="w-[123px] uppercase tracking-wide text-sm text-gray-500 dark:text-gray-300 font-semibold border-r border-gray-600 dark:border-gray-300 pr-5 mr-5">
                                                                Updated At
                                                            </p>
                                                            <p class="text-sm text-gray-600 dark:text-gray-200">
                                                                {{ auth()->user()->updated_at ? auth()->user()->updated_at : 'N/A' }}
                                                            </p>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <a href="{{ url('/profile') }}"
                                        class="block px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">Account
                                        settings</a>
                                </li>
                            </ul>
                            {{-- <ul class="py-1 text-gray-700 dark:text-gray-300" aria-labelledby="dropdown">
                            <li>
                                <a href="#"
                                    class="flex items-center px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"><svg
                                        class="w-5 h-5 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    My likes</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="flex items-center px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"><svg
                                        class="w-5 h-5 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z">
                                        </path>
                                    </svg>
                                    Collections</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="flex items-center justify-between px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    <span class="flex items-center">
                                        <svg aria-hidden="true"
                                            class="w-5 h-5 mr-2 text-primary-600 dark:text-primary-500"
                                            fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Pro version
                                    </span>
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-400" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                            </li>
                        </ul> --}}
                            <ul class="py-1 text-gray-700 dark:text-gray-300" aria-labelledby="dropdown">
                                <li>
                                    <a href="{{ route('logout') }}"
                                        class="block px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sign
                                        out</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Start Sidebar -->

            <aside
                class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0 dark:bg-gray-800 dark:border-gray-700 "
                aria-label="Sidenav" id="drawer-navigation">
                <a href="/" class="flex items-center justify-center p-3.5 border-b dark:border-b-slate-600">
                    @if ($websiteInfo->image)
                        <img src="{{ asset('assets/images/website_infos/logo192.png') }}"
                            class="object-cover h-8 mr-3 rounded-full aspect-square" alt="Flowbite Logo" />
                    @endif
                    <span class="self-center text-2xl font-semibold line-clamp-1 dark:text-white">
                        {{ $websiteInfo->name }}
                    </span>
                </a>
                <div class="h-full px-3 py-5 overflow-y-auto bg-white dark:bg-gray-800 pb-[8rem]">

                    <ul>
                        <li>
                            <x-sidebar-item href="{{ route('admin.dashboard.index') }}"
                                class="{{ request()->is('admin/dashboard*') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">
                                <img src="{{ asset('assets/icons/dashboard.png') }}" alt="icon"
                                    class="object-contain w-8 h-8 p-0.5 bg-white dark:bg-gray-200 rounded">
                                <span class="ml-3">Dashboard</span>
                            </x-sidebar-item>
                        </li>

                        @can('view user')
                        <li x-data="{
                                open: {{ request()->is('admin/users*') || request()->is('admin/roles*') || request()->is('admin/permissions*') ? 'true' : 'false' }},
                                init() {
                                    if ({{ request()->is('admin/users*') || request()->is('admin/roles*') || request()->is('admin/permissions*') ? 'true' : 'false' }}) {
                                        this.$nextTick(() => this.$refs.users.scrollIntoView({ behavior: 'smooth' }));
                                    }
                                }
                            }"
                             x-ref="users"
                             class="pt-1"
                        >
                            <button type="button"
                                class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/users*') ? 'bg-slate-200 dark:bg-slate-500' : '' }}"
                                :class="{ 'bg-slate-100 dark:bg-slate-700': open }"
                                @click="open = !open; if (open) $nextTick(() => $refs.users.scrollIntoView({ behavior: 'smooth' }))">
                                <img src="{{ asset('assets/icons/user.png') }}" alt="icon"
                                    class="object-contain w-8 h-8 bg-white rounded dark:bg-gray-200">
                                <span class="flex-1 text-left ms-3 rtl:text-right whitespace-nowrap">Users</span>
                                <svg class="w-3 h-3 transition-transform duration-200 transform"
                                    :class="{ 'rotate-180': open }" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                            <ul x-show="open" x-transition class="py-2 ml-2 space-y-2">
                                <li>
                                    <a href="{{ url('admin/users') }}"
                                        class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/users*') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">
                                        Users
                                    </a>
                                </li>
                                @can('view role')
                                <li>
                                    <a href="{{ url('admin/roles') }}"
                                        class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/roles*') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">
                                        Roles
                                    </a>
                                </li>
                                @endcan
                                {{-- <li>
                                    <a href="{{ url('admin/permissions') }}"
                                        class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/permissions*') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">
                                        Permissions
                                    </a>
                                </li> --}}

                            </ul>
                        </li>
                        @endcan



                        {{-- <li>
                        <x-sidebar-item href="{{ route('admin.customers.index') }}"
                            class="{{ request()->is('admin/customers*') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-contact">
                                <path d="M17 18a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2" />
                                <rect width="18" height="18" x="3" y="4" rx="2" />
                                <circle cx="12" cy="10" r="2" />
                                <line x1="8" x2="8" y1="2" y2="4" />
                                <line x1="16" x2="16" y1="2" y2="4" />
                            </svg>
                            <span class="ml-3">Customers</span>
                        </x-sidebar-item>
                    </li> --}}
                    </ul>

                    <ul class="pt-3 mt-5 border-t border-gray-200 dark:border-gray-700">
                        @forelse ($menu_databases as $database)
                            @if ($database->type != 'slug')
                                @continue
                            @endif
                            @switch($database->slug)
                                @case('publications')
                                    @can('view epublication')
                                    <li x-data="{
                                        open: {{ request()->is('admin/publications*') ? 'true' : 'false' }},
                                        init() {
                                            if ({{ request()->is('admin/publications*') ? 'true' : 'false' }}) {
                                                this.$nextTick(() => this.$refs.publications.scrollIntoView({ behavior: 'smooth' }));
                                            }
                                        }
                                    }" x-ref="publications" class="pt-1">
                                        <button type="button"
                                            class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/publications*') ? 'bg-slate-200 dark:bg-slate-500' : '' }}"
                                            :class="{ 'bg-slate-100 dark:bg-slate-700': open }"
                                            @click="open = !open; if (open) $nextTick(() => $refs.publications.scrollIntoView({ behavior: 'smooth' }))">
                                            <img src="{{ asset('assets/images/databases/' . $database->image) }}"
                                                alt="icon"
                                                class="object-contain w-8 h-8 p-0.5 bg-white dark:bg-gray-200 rounded">
                                            <span
                                                class="flex-1 text-left ms-3 rtl:text-right whitespace-nowrap">{{ $database->name }}</span>
                                            <svg class="w-3 h-3 transition-transform duration-200 transform"
                                                :class="{ 'rotate-180': open }" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="m1 1 4 4 4-4" />
                                            </svg>
                                        </button>
                                        <ul x-show="open" x-transition class="py-2 ml-2 space-y-2">
                                            <li>
                                                <a href="{{ url('admin/publications') }}"
                                                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/publications') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">
                                                    E-Publications
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ url('admin/publications_types') }}"
                                                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/publications_types') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">
                                                    Types</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('admin/publications_categories') }}"
                                                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/publications_categories') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">
                                                    Categories</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('admin/publications_sub_categories') }}"
                                                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/publications_sub_categories') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">
                                                    Sub-Categories</a>
                                            </li>
                                        </ul>
                                    </li>
                                    @endcan
                                @break

                                @case('videos')
                                    @can('view video')
                                    <li x-data="{
                                        open: {{ request()->is('admin/videos*') ? 'true' : 'false' }},
                                        init() {
                                            if ({{ request()->is('admin/videos*') ? 'true' : 'false' }}) {
                                                this.$nextTick(() => this.$refs.videos.scrollIntoView({ behavior: 'smooth' }));
                                            }
                                        }
                                    }" x-ref="videos" class="pt-1">
                                        <button type="button"
                                            class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/videos*') ? 'bg-slate-200 dark:bg-slate-500' : '' }}"
                                            :class="{ 'bg-slate-100 dark:bg-slate-700': open }"
                                            @click="open = !open; if (open) $nextTick(() => $refs.videos.scrollIntoView({ behavior: 'smooth' }))">
                                            <img src="{{ asset('assets/images/databases/' . $database->image) }}"
                                                alt="icon"
                                                class="object-contain w-8 h-8 p-0.5 bg-white dark:bg-gray-200 rounded">
                                            <span
                                                class="flex-1 text-left ms-3 rtl:text-right whitespace-nowrap">{{ $database->name }}</span>
                                            <svg class="w-3 h-3 transition-transform duration-200 transform"
                                                :class="{ 'rotate-180': open }" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="m1 1 4 4 4-4" />
                                            </svg>
                                        </button>
                                        <ul x-show="open" x-transition class="py-2 ml-2 space-y-2">
                                            <li>
                                                <a href="{{ route('admin.videos.index') }}"
                                                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/videos') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">Videos</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('admin/videos_types') }}"
                                                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/videos_types') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">
                                                    Types</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('admin/videos_categories') }}"
                                                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/videos_categories') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">
                                                    Categories</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('admin/videos_sub_categories') }}"
                                                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/videos_sub_categories') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">
                                                    Sub-Categories</a>
                                            </li>
                                        </ul>
                                    </li>
                                    @endcan
                                @break

                                @case('images')
                                    @can('view image')
                                    <li x-data="{
                                        open: {{ request()->is('admin/images*') ? 'true' : 'false' }},
                                        init() {
                                            if ({{ request()->is('admin/images*') ? 'true' : 'false' }}) {
                                                this.$nextTick(() => this.$refs.images.scrollIntoView({ behavior: 'smooth' }));
                                            }
                                        }
                                    }" x-ref="images" class="pt-1">
                                        <button type="button"
                                            class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/images*') ? 'bg-slate-200 dark:bg-slate-500' : '' }}"
                                            :class="{ 'bg-slate-100 dark:bg-slate-700': open }"
                                            @click="open = !open; if (open) $nextTick(() => $refs.images.scrollIntoView({ behavior: 'smooth' }))">
                                            <img src="{{ asset('assets/images/databases/' . $database->image) }}"
                                                alt="icon"
                                                class="object-contain w-8 h-8 p-0.5 bg-white dark:bg-gray-200 rounded">
                                            <span
                                                class="flex-1 text-left ms-3 rtl:text-right whitespace-nowrap">{{ $database->name }}</span>
                                            <svg class="w-3 h-3 transition-transform duration-200 transform"
                                                :class="{ 'rotate-180': open }" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="m1 1 4 4 4-4" />
                                            </svg>
                                        </button>
                                        <ul x-show="open" x-transition class="py-2 ml-2 space-y-2">
                                            <li>
                                                <a href="{{ route('admin.images.index') }}"
                                                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/images') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">Images</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('admin/images_types') }}"
                                                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/images_types') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">
                                                    Types</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('admin/images_categories') }}"
                                                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/images_categories') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">
                                                    Categories</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('admin/images_sub_categories') }}"
                                                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/images_sub_categories') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">
                                                    Sub-Categories</a>
                                            </li>
                                        </ul>
                                    </li>
                                    @endcan
                                @break

                                @case('audios')
                                    @can('view audio')
                                    <li x-data="{
                                        open: {{ request()->is('admin/audios*') ? 'true' : 'false' }},
                                        init() {
                                            if ({{ request()->is('admin/audios*') ? 'true' : 'false' }}) {
                                                this.$nextTick(() => this.$refs.audios.scrollIntoView({ behavior: 'smooth' }));
                                            }
                                        }
                                    }" x-ref="audios" class="pt-1">
                                        <button type="button"
                                            class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/audios*') ? 'bg-slate-200 dark:bg-slate-500' : '' }}"
                                            :class="{ 'bg-slate-100 dark:bg-slate-700': open }"
                                            @click="open = !open; if (open) $nextTick(() => $refs.audios.scrollIntoView({ behavior: 'smooth' }))">
                                            <img src="{{ asset('assets/images/databases/' . $database->image) }}"
                                                alt="icon"
                                                class="object-contain w-8 h-8 p-0.5 bg-white dark:bg-gray-200 rounded">
                                            <span
                                                class="flex-1 text-left ms-3 rtl:text-right whitespace-nowrap">{{ $database->name }}</span>
                                            <svg class="w-3 h-3 transition-transform duration-200 transform"
                                                :class="{ 'rotate-180': open }" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="m1 1 4 4 4-4" />
                                            </svg>
                                        </button>
                                        <ul x-show="open" x-transition class="py-2 ml-2 space-y-2">
                                            <li>
                                                <a href="{{ route('admin.audios.index') }}"
                                                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/audios') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">Audios</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('admin/audios_types') }}"
                                                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/audios_types') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">
                                                    Types</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('admin/audios_categories') }}"
                                                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/audios_categories') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">
                                                    Categories</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('admin/audios_sub_categories') }}"
                                                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/audios_sub_categories') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">
                                                    Sub-Categories</a>
                                            </li>
                                        </ul>
                                    </li>
                                    @endcan
                                @break

                                @case('bulletins')
                                    @can('view bulletin')
                                    <li x-data="{
                                        open: {{ request()->is('admin/bulletins*') ? 'true' : 'false' }},
                                        init() {
                                            if ({{ request()->is('admin/bulletins*') ? 'true' : 'false' }}) {
                                                this.$nextTick(() => this.$refs.bulletins.scrollIntoView({ behavior: 'smooth' }));
                                            }
                                        }
                                    }" x-ref="bulletins" class="pt-1">
                                        <button type="button"
                                            class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/bulletins*') ? 'bg-slate-200 dark:bg-slate-500' : '' }}"
                                            :class="{ 'bg-slate-100 dark:bg-slate-700': open }"
                                            @click="open = !open; if (open) $nextTick(() => $refs.bulletins.scrollIntoView({ behavior: 'smooth' }))">
                                            <img src="{{ asset('assets/images/databases/' . $database->image) }}"
                                                alt="icon"
                                                class="object-contain w-8 h-8 p-0.5 bg-white dark:bg-gray-200 rounded">
                                            <span
                                                class="flex-1 text-left ms-3 rtl:text-right whitespace-nowrap">{{ $database->name }}</span>
                                            <svg class="w-3 h-3 transition-transform duration-200 transform"
                                                :class="{ 'rotate-180': open }" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="m1 1 4 4 4-4" />
                                            </svg>
                                        </button>
                                        <ul x-show="open" x-transition class="py-2 ml-2 space-y-2">
                                            <li>
                                                <a href="{{ route('admin.bulletins.index') }}"
                                                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/bulletins') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">Bulletins</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('admin/bulletins_types') }}"
                                                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/bulletins_types') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">
                                                    Types</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('admin/bulletins_categories') }}"
                                                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/bulletins_categories') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">
                                                    Categories</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('admin/bulletins_sub_categories') }}"
                                                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/bulletins_sub_categories') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">
                                                    Sub-Categories</a>
                                            </li>
                                        </ul>
                                    </li>
                                    @endcan
                                @break

                                @case('theses')
                                    @can('view thesis')
                                    <li x-data="{
                                        open: {{ request()->is('admin/theses*') ? 'true' : 'false' }},
                                        init() {
                                            if ({{ request()->is('admin/theses*') ? 'true' : 'false' }}) {
                                                this.$nextTick(() => this.$refs.theses.scrollIntoView({ behavior: 'smooth' }));
                                            }
                                        }
                                    }" x-ref="theses" class="pt-1">
                                        <button type="button"
                                            class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/theses*') ? 'bg-slate-200 dark:bg-slate-500' : '' }}"
                                            :class="{ 'bg-slate-100 dark:bg-slate-700': open }"
                                            @click="open = !open; if (open) $nextTick(() => $refs.theses.scrollIntoView({ behavior: 'smooth' }))">
                                            <img src="{{ asset('assets/images/databases/' . $database->image) }}"
                                                alt="icon"
                                                class="object-contain w-8 h-8 p-0.5 bg-white dark:bg-gray-200 rounded">
                                            <span
                                                class="flex-1 text-left ms-3 rtl:text-right whitespace-nowrap">{{ $database->name }}</span>
                                            <svg class="w-3 h-3 transition-transform duration-200 transform"
                                                :class="{ 'rotate-180': open }" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="m1 1 4 4 4-4" />
                                            </svg>
                                        </button>
                                        <ul x-show="open" x-transition class="py-2 ml-2 space-y-2">
                                            <li>
                                                <a href="{{ route('admin.theses.index') }}"
                                                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/theses') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">Theses</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('admin/theses_types') }}"
                                                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/theses_types') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">
                                                    Types</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('admin/theses_categories') }}"
                                                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/theses_categories') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">
                                                    Categories</a>
                                            </li>
                                            {{-- <li>
                                    <a href="{{ url('admin/theses_sub_categories') }}"
                                        class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/theses_sub_categories') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">
                                        Sub-Categories</a>
                                </li> --}}
                                        </ul>
                                    </li>
                                    @endcan
                                @break

                                @case('journals')
                                    @can('view journal')
                                    <li x-data="{
                                        open: {{ request()->is('admin/journals*') ? 'true' : 'false' }},
                                        init() {
                                            if ({{ request()->is('admin/journals*') ? 'true' : 'false' }}) {
                                                this.$nextTick(() => this.$refs.journals.scrollIntoView({ behavior: 'smooth' }));
                                            }
                                        }
                                    }" x-ref="journals" class="pt-1">
                                        <button type="button"
                                            class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/journals*') ? 'bg-slate-200 dark:bg-slate-500' : '' }}"
                                            :class="{ 'bg-slate-100 dark:bg-slate-700': open }"
                                            @click="open = !open; if (open) $nextTick(() => $refs.journals.scrollIntoView({ behavior: 'smooth' }))">
                                            <img src="{{ asset('assets/images/databases/' . $database->image) }}"
                                                alt="icon"
                                                class="object-contain w-8 h-8 p-0.5 bg-white dark:bg-gray-200 rounded">
                                            <span
                                                class="flex-1 text-left ms-3 rtl:text-right whitespace-nowrap">{{ $database->name }}</span>
                                            <svg class="w-3 h-3 transition-transform duration-200 transform"
                                                :class="{ 'rotate-180': open }" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="m1 1 4 4 4-4" />
                                            </svg>
                                        </button>
                                        <ul x-show="open" x-transition class="py-2 ml-2 space-y-2">
                                            <li>
                                                <a href="{{ route('admin.journals.index') }}"
                                                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/journals') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">Journals</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('admin/journals_types') }}"
                                                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/journals_types') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">
                                                    Types</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('admin/journals_categories') }}"
                                                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/journals_categories') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">
                                                    Categories</a>
                                            </li>
                                            {{-- <li>
                                    <a href="{{ url('admin/journals_sub_categories') }}"
                                        class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/journals_sub_categories') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">
                                        Sub-Categories</a>
                                </li> --}}
                                        </ul>
                                    </li>
                                    @endcan
                                @break

                                @case('articles')
                                    @can('view article')
                                    <li x-data="{
                                        open: {{ request()->is('admin/articles*') ? 'true' : 'false' }},
                                        init() {
                                            if ({{ request()->is('admin/articles*') ? 'true' : 'false' }}) {
                                                this.$nextTick(() => this.$refs.articles.scrollIntoView({ behavior: 'smooth' }));
                                            }
                                        }
                                    }" x-ref="articles" class="pt-1">
                                        <button type="button"
                                            class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/articles*') ? 'bg-slate-200 dark:bg-slate-500' : '' }}"
                                            :class="{ 'bg-slate-100 dark:bg-slate-700': open }"
                                            @click="open = !open; if (open) $nextTick(() => $refs.articles.scrollIntoView({ behavior: 'smooth' }))">
                                            <img src="{{ asset('assets/images/databases/' . $database->image) }}"
                                                alt="icon"
                                                class="object-contain w-8 h-8 p-0.5 bg-white dark:bg-gray-200 rounded">
                                            <span
                                                class="flex-1 text-left ms-3 rtl:text-right whitespace-nowrap">{{ $database->name }}</span>
                                            <svg class="w-3 h-3 transition-transform duration-200 transform"
                                                :class="{ 'rotate-180': open }" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="m1 1 4 4 4-4" />
                                            </svg>
                                        </button>
                                        <ul x-show="open" x-transition class="py-2 ml-2 space-y-2">
                                            <li>
                                                <a href="{{ route('admin.articles.index') }}"
                                                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/articles') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">Articles</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('admin/articles_types') }}"
                                                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/articles_types') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">
                                                    Types</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('admin/articles_categories') }}"
                                                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/articles_categories') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">
                                                    Categories</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('admin/articles_sub_categories') }}"
                                                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/articles_sub_categories') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">
                                                    Sub-Categories</a>
                                            </li>
                                        </ul>
                                    </li>
                                    @endcan
                                @break
                            @endswitch
                            @empty
                                <li class="mt-1">No Databases...</li>
                            @endforelse

                        </ul>

                        <ul class="pt-5 mt-5 space-y-1 border-t border-gray-200 dark:border-gray-700">
                            @can('view keyword')
                            <li x-data="{
                                init() {
                                    if ({{ request()->is('admin/keywords*') ? 'true' : 'false' }}) {
                                        this.$nextTick(() => this.$refs.keywords.scrollIntoView({ behavior: 'smooth' }));
                                    }
                                }
                            }" x-ref="keywords">
                                <x-sidebar-item href="{{ route('admin.keywords.index') }}"
                                    class="{{ request()->is('admin/keywords*') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">
                                    <img src="{{ asset('assets/icons/keyword.png') }}" alt="icon"
                                        class="object-contain w-8 h-8 p-0.5 bg-white dark:bg-gray-200 rounded">
                                    <span class="ml-3">Keywords</span>
                                </x-sidebar-item>
                            </li>
                            @endcan

                            @can('view location')
                            <li x-data="{
                                init() {
                                    if ({{ request()->is('admin/locations*') ? 'true' : 'false' }}) {
                                        this.$nextTick(() => this.$refs.locations.scrollIntoView({ behavior: 'smooth' }));
                                    }
                                }
                            }" x-ref="locations">
                                <x-sidebar-item href="{{ route('admin.locations.index') }}"
                                    class="{{ request()->is('admin/locations*') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">
                                    <img src="{{ asset('assets/icons/location.png') }}" alt="icon"
                                        class="object-contain w-8 h-8 p-0.5 bg-white dark:bg-gray-200 rounded">
                                    <span class="ml-3">Locations</span>
                                </x-sidebar-item>
                            </li>
                            @endcan

                            @can('view language')
                            <li x-data="{
                                init() {
                                    if ({{ request()->is('admin/languages*') ? 'true' : 'false' }}) {
                                        this.$nextTick(() => this.$refs.languages.scrollIntoView({ behavior: 'smooth' }));
                                    }
                                }
                            }" x-ref="languages">
                                <x-sidebar-item href="{{ route('admin.languages.index') }}"
                                    class="{{ request()->is('admin/languages*') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">
                                    <img src="{{ asset('assets/icons/language.png') }}" alt="icon"
                                        class="object-contain w-8 h-8 p-0.5 bg-white dark:bg-gray-200 rounded">
                                    <span class="ml-3">Languages</span>
                                </x-sidebar-item>
                            </li>
                            @endcan

                            {{-- @can('view major')
                            <li x-data="{
                                init() {
                                    if ({{ request()->is('admin/majors*') ? 'true' : 'false' }}) {
                                        this.$nextTick(() => this.$refs.majors.scrollIntoView({ behavior: 'smooth' }));
                                    }
                                }
                            }" x-ref="majors">
                                <x-sidebar-item href="{{ route('admin.majors.index') }}"
                                    class="{{ request()->is('admin/majors*') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">
                                    <img src="{{ asset('assets/icons/major.png') }}" alt="icon"
                                        class="object-contain w-8 h-8 p-0.5 bg-white dark:bg-gray-200 rounded">
                                    <span class="ml-3">Majors</span>
                                </x-sidebar-item>
                            </li>
                            @endcan --}}

                            {{-- <li>
                        <x-sidebar-item href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clipboard-minus">
                                <rect width="8" height="4" x="8" y="2" rx="1" ry="1" />
                                <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" />
                                <path d="M9 14h6" />
                            </svg>
                            <span class="ml-3">Reports</span>
                        </x-sidebar-item>
                    </li> --}}
                            @can('view people')
                            <ul>
                                <li x-data="{
                                    open: {{ request()->is('admin/people*') ? 'true' : 'false' }},
                                    init() {
                                        if ({{ request()->is('admin/people*') ? 'true' : 'false' }}) {
                                            this.$nextTick(() => this.$refs.dropdown.scrollIntoView({ behavior: 'smooth' }));
                                        }
                                    }
                                }">
                                    <button type="button"
                                        class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/people*') ? 'bg-slate-200 dark:bg-slate-500' : '' }}"
                                        :class="{ 'bg-slate-100 dark:bg-slate-700': open }"
                                        @click="open = !open; if (open) $nextTick(() => $refs.dropdown.scrollIntoView({ behavior: 'smooth' }))">
                                        <img src="{{ asset('assets/icons/people.png') }}" alt="icon"
                                            class="object-contain w-8 h-8 bg-white rounded dark:bg-gray-200">
                                        <span class="flex-1 text-left ms-3 rtl:text-right whitespace-nowrap">People</span>
                                        <svg class="w-3 h-3 transition-transform duration-200 transform"
                                            :class="{ 'rotate-180': open }" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 4 4 4-4" />
                                        </svg>
                                    </button>
                                    <ul x-show="open" x-transition class="py-2 ml-2 space-y-2" x-ref="dropdown">
                                        <li>
                                            <a href="{{ url('admin/people/authors') }}"
                                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/people/authors*') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">
                                                Authors
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ url('admin/people/publishers') }}"
                                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/people/publishers*') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">
                                                Publishers
                                            </a>
                                        </li>
                                        {{-- <li>
                                            <a href="{{ url('admin/people/students') }}"
                                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/people/students*') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">
                                                Students
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ url('admin/people/supervisors') }}"
                                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/people/supervisors*') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">
                                                Supervisors
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ url('admin/people/lecturers') }}"
                                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/people/lecturers*') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">
                                                Lecturers
                                            </a>
                                        </li> --}}
                                    </ul>
                                </li>
                            </ul>
                            @endcan
                        </ul>

                        @can('view setting')
                        <ul class="pt-5 pb-5 mt-5 space-y-2 border-t border-gray-200 dark:border-gray-700">
                            <li x-data="{
                                open: {{ request()->is('admin/settings*') ? 'true' : 'false' }},
                                init() {
                                    if ({{ request()->is('admin/settings*') ? 'true' : 'false' }}) {
                                        this.$nextTick(() => this.$refs.dropdown.scrollIntoView({ behavior: 'smooth' }));
                                    }
                                }
                            }">
                                <button type="button"
                                    class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/settings*') ? 'bg-slate-200 dark:bg-slate-500' : '' }}"
                                    :class="{ 'bg-slate-100 dark:bg-slate-700': open }"
                                    @click="open = !open; if (open) $nextTick(() => $refs.dropdown.scrollIntoView({ behavior: 'smooth' }))">
                                    <img src="{{ asset('assets/icons/settings.png') }}" alt="icon"
                                        class="object-contain w-8 h-8 p-0.5 bg-white dark:bg-gray-200 rounded">
                                    <span class="flex-1 text-left ms-3 rtl:text-right whitespace-nowrap">Settings</span>
                                    <svg class="w-3 h-3 transition-transform duration-200 transform"
                                        :class="{ 'rotate-180': open }" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 4 4 4-4" />
                                    </svg>
                                </button>
                                <ul x-show="open" x-transition class="py-2 ml-2 space-y-2" x-ref="dropdown">
                                    <li>
                                        <a href="{{ url('admin/settings/slides') }}"
                                            class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/settings/slides*') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">
                                            Slides
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('admin/settings/menus') }}"
                                            class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/settings/menus*') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">
                                            Menus
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('admin/settings/links') }}"
                                            class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/settings/links*') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">
                                            Links
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('admin/settings/footer/1/edit') }}"
                                            class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/settings/footer*') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">
                                            Footer
                                        </a>
                                    </li>
                                    @can('view database')
                                    <li>
                                        <a href="{{ url('admin/settings/databases') }}"
                                            class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/settings/databases*') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">
                                            Databases
                                        </a>
                                    </li>
                                    @endcan

                                    <li>
                                        <a href="{{ url('admin/settings/website_infos/1/edit') }}"
                                            class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/settings/website_infos*') ? 'bg-slate-200 dark:bg-slate-500' : '' }}">
                                            Website Info
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        @endcan

                    </div>
                    <div
                        class="absolute bottom-0 z-20 flex justify-center w-full p-4 space-x-4 bg-white border-t dark:border-t-slate-600 dark:bg-gray-800">
                        <button id="theme-toggle" type="button"
                            class="p-2 text-sm text-gray-600 rounded-lg hover:text-gray-500 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700">
                            <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                            </svg>
                            <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                    fill-rule="evenodd" clip-rule="evenodd"></path>
                            </svg>
                        </button>

                        <a href="{{ url('/profile') }}" data-tooltip-target="tooltip-settings"
                            class="inline-flex justify-center p-2 text-gray-600 rounded cursor-pointer dark:text-gray-300 dark:hover:text-white hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-user-round-cog">
                                <path d="M2 21a8 8 0 0 1 10.434-7.62" />
                                <circle cx="10" cy="8" r="5" />
                                <circle cx="18" cy="18" r="3" />
                                <path d="m19.5 14.3-.4.9" />
                                <path d="m16.9 20.8-.4.9" />
                                <path d="m21.7 19.5-.9-.4" />
                                <path d="m15.2 16.9-.9-.4" />
                                <path d="m21.7 16.5-.9.4" />
                                <path d="m15.2 19.1-.9.4" />
                                <path d="m19.5 21.7-.4-.9" />
                                <path d="m16.9 15.2-.4-.9" />
                            </svg>
                            </svg>
                        </a>
                        <div id="tooltip-settings" role="tooltip"
                            class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                            Account Settings
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                        <button type="button" data-dropdown-toggle="language-dropdown"
                            class="inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer dark:hover:text-white dark:text-gray-400 hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-600">
                            <img src="{{ asset('assets/icons/english.png') }}" alt="icon"
                                class="object-contain w-6 h-6 border rounded-full">
                        </button>
                        <!-- Dropdown -->
                        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700"
                            id="language-dropdown">
                            <ul class="py-1" role="none">
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:text-white dark:text-gray-300 dark:hover:bg-gray-600"
                                        role="menuitem">
                                        <div class="inline-flex items-center">
                                            <img src="{{ asset('assets/icons/khmer.png') }}" alt="icon"
                                                class="object-contain w-6 h-6 mr-2 border rounded-full">
                                            Khmer (KH)
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:text-white dark:text-gray-300 dark:hover:bg-gray-600"
                                        role="menuitem">
                                        <div class="inline-flex items-center">
                                            <img src="{{ asset('assets/icons/english.png') }}" alt="icon"
                                                class="object-contain w-6 h-6 mr-2 border rounded-full">
                                            English (US)
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </aside>

                <main class="h-auto p-4 pt-20 md:ml-64 dark:bg-gray-800">
                    <section class="dark:bg-gray-900">
                        <div class="mx-auto max-w-screen-2xl ">
                            <div
                                class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg  min-h-[80vh] mb-4">
                                @yield('content')
                            </div>
                        </div>
                    </section>
                </main>
            </div>

            <script src="{{ asset('assets/js/flowbite2.3.js') }}"></script>
            <script src="{{ asset('assets/js/glightbox.js') }}"></script>
            <script src="{{ asset('assets/js/glightbox.config.js') }}"></script>
            <script src="{{ asset('/assets/ckeditor/ckeditor4/ckeditor.js') }}"></script>
            <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
                crossorigin="anonymous"></script>
            <script>
                // let options = {
                //     filebrowserImageBrowseUrl: "{{ asset('laravel-filemanager?type=Images') }}",
                //     filebrowserImageUploadUrl: "{{ asset('laravel-filemanager/upload?type=Images&_token=') }}",
                //     filebrowserBrowseUrl: "{{ asset('laravel-filemanager?type=Files') }}",
                //     filebrowserUploadUrl: "{{ asset('laravel-filemanager/upload?type=Files&_token=') }}"
                // };
                // let areas = Array('details', 'description', 'description_kh');
                // areas.forEach(function(area) {
                //     CKEDITOR.replace(area, options);
                // });
            </script>
            <script>
                // Prevent Submit from click ENTER key
                const form = document.querySelector('form');
                form.addEventListener('keydown', function(event) {
                    // Check if the key pressed is Enter (key code 13)
                    if (event.keyCode === 13) {
                        event.preventDefault(); // Prevent form submission
                    }
                });
            </script>
            {{-- @stack('scripts') --}}

            {{-- <script>
        document.addEventListener('livewire:navigated', () => {
            initFlowbite();
        });
    </script> --}}


        </body>


        </html>
