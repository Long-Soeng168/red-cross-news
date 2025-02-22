@props(['value'])

<label {{ $attributes->merge(['class' => 'mb-4 text-sm font-medium text-gray-600 dark:text-white']) }}>
    {{ $value ?? $slot }}
</label>
