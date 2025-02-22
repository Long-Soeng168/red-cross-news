<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            {{ __('Slide Show Infinite') }}
        </h2>
        <x-swiper class="mb-10"/>
        <x-swiper-responsive class="mb-10" />
    </x-slot>
</x-app-layout>
