@extends('layouts.client')

@section('content')
    {{-- Start Search --}}
    @include('client.components.search', [
        'actionUrl' => url('/'.$menu_database_default->slug),
        'title' => $menu_database_default->name,
        'title_kh' => $menu_database_default->name_kh,
    ])
    {{-- End Search --}}

    <div class="max-w-screen-xl px-2 py-6 mx-auto min-h-[30vh]">
        <h1 class="mb-4 text-2xl font-extrabold leading-tight text-gray-700 dark:text-gray-200 lg:mb-6 lg:text-4xlndark:text-white">
            @if (app()->getLocale() == 'kh' && $item->name_kh)
            {{ $item->name_kh }}
            @else
            {{ $item->name }}
            @endif
        </h1>
        <div class="text-gray-600 dark:text-gray-300 no-tailwind">
            @if (app()->getLocale() == 'kh' && $item->description_kh)
            {!! $item->description_kh !!}
            @else
            {!! $item->description !!}
            @endif

        </div>
    </div>
@endsection
