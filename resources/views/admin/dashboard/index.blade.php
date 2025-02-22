@extends('admin.layouts.admin')
@section('content')
    <div>
        <div class="grid grid-cols-1 gap-4 mx-4 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-6">
            <div class="w-full p-4 m-auto rounded-lg sm:col-span-1 md:col-span-2 lg:col-span-2">
                <canvas id="chartPie"></canvas>
            </div>
            <div class="w-full p-4 mx-auto rounded-lg sm:col-span-1 md:col-span-2 lg:col-span-4">
                <canvas id="chartBar"></canvas>
            </div>
        </div>
        {{-- <div class="max-w-screen-md mx-auto max-h-[400px]">
            <canvas id="chartBar"></canvas>
        </div> --}}

        <div class="p-4">

            <div class="grid items-start grid-cols-3 gap-4 sm:grid-cols-3 lg:grid-cols-{{ (count($menu_databases) <= 5) ? count($menu_databases) : '6' }}">
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
                                        class="object-contain h-20 aspect-square p-0.5 bg-white dark:bg-gray-200 rounded">
                                    <div class="text-lg font-bold text-gray-600 dark:text-white">Publications</div>
                                    <div>
                                        <div class="flex text-sm text-gray-400">
                                            <span class="flex">
                                                <img src="{{ asset('assets/icons/total.png') }}" class="object-contain w-4 h-4 mr-1" alt="">
                                                Records :
                                            </span>
                                            <p class="font-bold text-center text-gray-500 dark:text-gray-200">
                                               {{ $totalCountEachArchive['publications'] }}
                                            </p>
                                        </div>
                                        <div class="flex text-sm text-gray-400">
                                            <span class="flex">
                                                <img src="{{ asset('assets/icons/open-eye.png') }}" class="object-contain w-4 h-4 mr-1" alt="">
                                                Read :
                                            </span>
                                            <p class="font-bold text-center text-gray-500 dark:text-gray-200">
                                               {{ $readCounts['publications'] }}
                                            </p>
                                        </div>
                                        <div class="flex gap-2 text-sm text-gray-400">
                                            <span class="flex">
                                                <img src="{{ asset('assets/icons/download.png') }}" class="object-contain w-4 h-4 mr-1" alt="">
                                                Download :
                                            </span>
                                            <p class="font-bold text-center text-gray-500 dark:text-gray-200">
                                               {{ $downloadCounts['publications'] }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            @endcan
                        @break

                        @case('videos')
                            @can('view video')
                                <a href="{{ url('admin/videos') }}"
                                    class="{{ request()->is('admin/videos*') ? 'bg-slate-200 dark:bg-slate-500' : '' }} flex flex-col items-center justify-center p-4 text-center rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 group">
                                    <img src="{{ asset('assets/images/databases/' . $database->image) }}" alt="icon"
                                        class="object-contain h-20 aspect-square p-0.5 bg-white dark:bg-gray-200 rounded">
                                    <div class="text-lg font-bold text-gray-600 dark:text-white">Videos</div>
                                    <div>
                                        <div class="flex text-sm text-gray-400">
                                            <span class="flex">
                                                <img src="{{ asset('assets/icons/total.png') }}" class="object-contain w-4 h-4 mr-1" alt="">
                                                Records :
                                            </span>
                                            <p class="font-bold text-center text-gray-500 dark:text-gray-200">
                                               {{ $totalCountEachArchive['videos'] }}
                                            </p>
                                        </div>
                                        <div class="flex text-sm text-gray-400">
                                            <span class="flex">
                                                <img src="{{ asset('assets/icons/open-eye.png') }}" class="object-contain w-4 h-4 mr-1" alt="">
                                                View :
                                            </span>
                                            <p class="font-bold text-center text-gray-500 dark:text-gray-200">
                                               {{ $readCounts['videos'] }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            @endcan
                        @break

                        @case('images')
                            @can('view image')
                                <a href="{{ url('admin/images') }}"
                                    class="{{ request()->is('admin/images*') ? 'bg-slate-200 dark:bg-slate-500' : '' }} flex flex-col items-center justify-center p-4 text-center rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 group">
                                    <img src="{{ asset('assets/images/databases/' . $database->image) }}" alt="icon"
                                        class="object-contain h-20 aspect-square p-0.5 bg-white dark:bg-gray-200 rounded">
                                        <div class="text-lg font-bold text-gray-600 dark:text-white">Images</div>
                                        <div>
                                            <div class="flex text-sm text-gray-400">
                                                <span class="flex">
                                                    <img src="{{ asset('assets/icons/total.png') }}" class="object-contain w-4 h-4 mr-1" alt="">
                                                    Records :
                                                </span>
                                                <p class="font-bold text-center text-gray-500 dark:text-gray-200">
                                                   {{ $totalCountEachArchive['images'] }}
                                                </p>
                                            </div>
                                            <div class="flex text-sm text-gray-400">
                                                <span class="flex">
                                                    <img src="{{ asset('assets/icons/open-eye.png') }}" class="object-contain w-4 h-4 mr-1" alt="">
                                                    View :
                                                </span>
                                                <p class="font-bold text-center text-gray-500 dark:text-gray-200">
                                                   {{ $readCounts['images'] }}
                                                </p>
                                            </div>
                                        </div>
                                </a>
                            @endcan
                        @break

                        @case('audios')
                            @can('view audio')
                                <a href="{{ url('admin/audios') }}"
                                    class="{{ request()->is('admin/audios*') ? 'bg-slate-200 dark:bg-slate-500' : '' }} flex flex-col items-center justify-center p-4 text-center rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 group">
                                    <img src="{{ asset('assets/images/databases/' . $database->image) }}" alt="icon"
                                        class="object-contain h-20 aspect-square p-0.5 bg-white dark:bg-gray-200 rounded">
                                        <div class="text-lg font-bold text-gray-600 dark:text-white">Audios</div>
                                        <div>
                                            <div class="flex text-sm text-gray-400">
                                                <span class="flex">
                                                    <img src="{{ asset('assets/icons/total.png') }}" class="object-contain w-4 h-4 mr-1" alt="">
                                                    Records :
                                                </span>
                                                <p class="font-bold text-center text-gray-500 dark:text-gray-200">
                                                   {{ $totalCountEachArchive['audios'] }}
                                                </p>
                                            </div>
                                            <div class="flex text-sm text-gray-400">
                                                <span class="flex">
                                                    <img src="{{ asset('assets/icons/open-eye.png') }}" class="object-contain w-4 h-4 mr-1" alt="">
                                                    Listen :
                                                </span>
                                                <p class="font-bold text-center text-gray-500 dark:text-gray-200">
                                                   {{ $readCounts['audios'] }}
                                                </p>
                                            </div>
                                        </div>
                                </a>
                            @endcan
                        @break

                        @case('bulletins')
                            @can('view bulletin')
                                <a href="{{ url('admin/bulletins') }}"
                                    class="{{ request()->is('admin/bulletins*') ? 'bg-slate-200 dark:bg-slate-500' : '' }} flex flex-col items-center justify-center p-4 text-center rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 group">
                                    <img src="{{ asset('assets/images/databases/' . $database->image) }}" alt="icon"
                                        class="object-contain h-20 aspect-square p-0.5 bg-white dark:bg-gray-200 rounded">
                                        <div class="text-lg font-bold text-gray-600 dark:text-white">Bulletins</div>
                                        <div>
                                            <div class="flex text-sm text-gray-400">
                                                <span class="flex">
                                                    <img src="{{ asset('assets/icons/total.png') }}" class="object-contain w-4 h-4 mr-1" alt="">
                                                    Records :
                                                </span>
                                                <p class="font-bold text-center text-gray-500 dark:text-gray-200">
                                                   {{ $totalCountEachArchive['bulletins'] }}
                                                </p>
                                            </div>
                                            <div class="flex text-sm text-gray-400">
                                                <span class="flex">
                                                    <img src="{{ asset('assets/icons/open-eye.png') }}" class="object-contain w-4 h-4 mr-1" alt="">
                                                    Read :
                                                </span>
                                                <p class="font-bold text-center text-gray-500 dark:text-gray-200">
                                                   {{ $readCounts['bulletins'] }}
                                                </p>
                                            </div>
                                            <div class="flex gap-2 text-sm text-gray-400">
                                                <span class="flex">
                                                    <img src="{{ asset('assets/icons/download.png') }}" class="object-contain w-4 h-4 mr-1" alt="">
                                                    Download :
                                                </span>
                                                <p class="font-bold text-center text-gray-500 dark:text-gray-200">
                                                   {{ $downloadCounts['bulletins'] }}
                                                </p>
                                            </div>
                                        </div>
                                </a>
                            @endcan
                        @break

                        @case('theses')
                            @can('view thesis')
                                <a href="{{ url('admin/theses') }}"
                                    class="{{ request()->is('admin/theses*') ? 'bg-slate-200 dark:bg-slate-500' : '' }} flex flex-col items-center justify-center p-4 text-center rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 group">
                                    <img src="{{ asset('assets/images/databases/' . $database->image) }}" alt="icon"
                                        class="object-contain h-20 aspect-square p-0.5 bg-white dark:bg-gray-200 rounded">
                                        <div class="text-lg font-bold text-gray-600 dark:text-white">Theses</div>
                                        <div>
                                            <div class="flex text-sm text-gray-400">
                                                <span class="flex">
                                                    <img src="{{ asset('assets/icons/total.png') }}" class="object-contain w-4 h-4 mr-1" alt="">
                                                    Records :
                                                </span>
                                                <p class="font-bold text-center text-gray-500 dark:text-gray-200">
                                                   {{ $totalCountEachArchive['theses'] }}
                                                </p>
                                            </div>
                                            <div class="flex text-sm text-gray-400">
                                                <span class="flex">
                                                    <img src="{{ asset('assets/icons/open-eye.png') }}" class="object-contain w-4 h-4 mr-1" alt="">
                                                    Read :
                                                </span>
                                                <p class="font-bold text-center text-gray-500 dark:text-gray-200">
                                                   {{ $readCounts['theses'] }}
                                                </p>
                                            </div>
                                            <div class="flex gap-2 text-sm text-gray-400">
                                                <span class="flex">
                                                    <img src="{{ asset('assets/icons/download.png') }}" class="object-contain w-4 h-4 mr-1" alt="">
                                                    Download :
                                                </span>
                                                <p class="font-bold text-center text-gray-500 dark:text-gray-200">
                                                   {{ $downloadCounts['theses'] }}
                                                </p>
                                            </div>
                                        </div>
                                </a>
                            @endcan
                        @break

                        @case('journals')
                            @can('view journal')
                                <a href="{{ url('admin/journals') }}"
                                    class="{{ request()->is('admin/journals*') ? 'bg-slate-200 dark:bg-slate-500' : '' }} flex flex-col items-center justify-center p-4 text-center rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 group">
                                    <img src="{{ asset('assets/images/databases/' . $database->image) }}" alt="icon"
                                        class="object-contain h-20 aspect-square p-0.5 bg-white dark:bg-gray-200 rounded">
                                        <div class="text-lg font-bold text-gray-600 dark:text-white">Journals</div>
                                        <div>
                                            <div class="flex text-sm text-gray-400">
                                                <span class="flex">
                                                    <img src="{{ asset('assets/icons/total.png') }}" class="object-contain w-4 h-4 mr-1" alt="">
                                                    Records :
                                                </span>
                                                <p class="font-bold text-center text-gray-500 dark:text-gray-200">
                                                   {{ $totalCountEachArchive['journals'] }}
                                                </p>
                                            </div>
                                            <div class="flex text-sm text-gray-400">
                                                <span class="flex">
                                                    <img src="{{ asset('assets/icons/open-eye.png') }}" class="object-contain w-4 h-4 mr-1" alt="">
                                                    Read :
                                                </span>
                                                <p class="font-bold text-center text-gray-500 dark:text-gray-200">
                                                   {{ $readCounts['journals'] }}
                                                </p>
                                            </div>
                                            <div class="flex gap-2 text-sm text-gray-400">
                                                <span class="flex">
                                                    <img src="{{ asset('assets/icons/download.png') }}" class="object-contain w-4 h-4 mr-1" alt="">
                                                    Download :
                                                </span>
                                                <p class="font-bold text-center text-gray-500 dark:text-gray-200">
                                                   {{ $downloadCounts['journals'] }}
                                                </p>
                                            </div>
                                        </div>
                                </a>
                            @endcan
                        @break

                        @case('articles')
                            @can('view article')
                                <a href="{{ url('admin/articles') }}"
                                    class="{{ request()->is('admin/articles*') ? 'bg-slate-200 dark:bg-slate-500' : '' }} flex flex-col items-center justify-center p-4 text-center rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 group">
                                    <img src="{{ asset('assets/images/databases/' . $database->image) }}" alt="icon"
                                        class="object-contain h-20 aspect-square p-0.5 bg-white dark:bg-gray-200 rounded">
                                        <div class="text-lg font-bold text-gray-600 dark:text-white">Articles</div>
                                        <div>
                                            <div class="flex text-sm text-gray-400">
                                                <span class="flex">
                                                    <img src="{{ asset('assets/icons/total.png') }}" class="object-contain w-4 h-4 mr-1" alt="">
                                                    Records :
                                                </span>
                                                <p class="font-bold text-center text-gray-500 dark:text-gray-200">
                                                   {{ $totalCountEachArchive['articles'] }}
                                                </p>
                                            </div>
                                            <div class="flex text-sm text-gray-400">
                                                <span class="flex">
                                                    <img src="{{ asset('assets/icons/open-eye.png') }}" class="object-contain w-4 h-4 mr-1" alt="">
                                                    Read :
                                                </span>
                                                <p class="font-bold text-center text-gray-500 dark:text-gray-200">
                                                   {{ $readCounts['articles'] }}
                                                </p>
                                            </div>
                                            <div class="flex gap-2 text-sm text-gray-400">
                                                <span class="flex">
                                                    <img src="{{ asset('assets/icons/download.png') }}" class="object-contain w-4 h-4 mr-1" alt="">
                                                    Download :
                                                </span>
                                                <p class="font-bold text-center text-gray-500 dark:text-gray-200">
                                                   {{ $downloadCounts['articles'] }}
                                                </p>
                                            </div>
                                        </div>
                                </a>
                            @endcan
                        @break
                    @endswitch
                    @empty
                    @endforelse

                </div>
            </div>

        </div>
        </div>


        <script src="{{ asset('assets/js/chartjs.js') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var ctx = document.getElementById('chartBar').getContext('2d');
                var chartBar = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: @json($label),
                        datasets: [{
                            label: "Archive Records",
                            data: @json($data),
                            backgroundColor: [
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(153, 102, 255, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(153, 102, 255, 1)'
                            ],
                            borderWidth: 3,
                            pointRadius: 10,
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                var ctx = document.getElementById('chartPie').getContext('2d');
                var chartPie = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['Users', 'Authors', 'Publishers'],
                        datasets: [{
                            label: "Records",
                            data: [
                                {{ $totalCountEachArchive['users'] }},
                                {{ $totalCountEachArchive['authors'] }},
                                {{ $totalCountEachArchive['publishers'] }},

                            ],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
        </script>

    @endsection
