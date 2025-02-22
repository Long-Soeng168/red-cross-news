<!-- resources/views/components/file-input.blade.php -->
<input {{ $attributes->merge([
    'class' => 'w-full bg-gray-50 px-4 py-1.5 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white',
    'type' => 'file',
]) }}>
