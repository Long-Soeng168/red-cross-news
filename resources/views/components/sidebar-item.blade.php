<a {{ $attributes->merge([
    'class' => 'flex items-center p-2 text-base font-medium text-gray-600 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group'
]) }}>
    {{ $slot }}
</a>

