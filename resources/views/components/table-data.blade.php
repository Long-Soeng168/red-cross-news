@props(['value'])

<td {{ $attributes->merge(['class' => 'px-4 py-2 font-medium text-gray-900 dark:text-white']) }}>
    <p class="line-clamp-2">
        {{ $value ?? $slot }}
    </p>
</td>
