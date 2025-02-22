@props(['value'])
<div {{ $attributes->merge(['class' => 'flex justify-between pl-0 items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600']) }} >
    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
        {{ $value ?? $slot }}
    </h3>
</div>
