@extends('layouts.default')

@section('content')
<div class="overflow-hidden bg-white ">
    @if (session('status'))
    <div class="relative px-4 py-3 text-blue-700 bg-blue-100 border border-blue-500" role="alert">
        <p>{{ session('status') }}</p>
    </div>
    @endif

    <div class="p-6 border-b border-gray-200 bg-gray-50">
        <div class="flex items-center justify-between">
            <h4 class="text-xl font-semibold text-gray-800">
                Role:
                <span class="font-bold text-blue-700 uppercase">{{ $role->name }}</span>
            </h4>
        </div>
    </div>

    <div class="p-6 ">
        <form action='{{ url("roles/$role->id/give-permissions") }}' method="POST" class="w-auto p-4 mx-auto rounded-lg shadow-lg">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <div class="flex items-center justify-between pb-2 mb-6 border-b">
                    <label for="permissions" class="text-lg font-bold text-gray-700">Permissions</label>
                    <div class="flex items-center">
                        <input type="checkbox" id="toggle_all_permissions" class="w-5 h-5 text-blue-600 form-checkbox">
                        <label for="toggle_all_permissions" class="ml-2 text-sm text-gray-600">Give All Permissions</label>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4" id="permissionsContainer">
                    @foreach ($permissions as $permission)
                    <div class="flex items-center">
                        <input
                            type="checkbox"
                            id="permission_{{ $permission->id }}"
                            name="permissions[]"
                            value="{{ $permission->name }}"
                            class="w-5 h-5 mr-2 text-blue-600 form-checkbox permission-checkbox"
                            {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}
                        >
                        <label for="permission_{{ $permission->id }}" class="text-gray-700">{{ $permission->name }}</label>
                    </div>
                    @endforeach
                </div>

                <x-input-error :messages="$errors->get('permissions')" class="mt-2" />

                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        var toggleAllCheckbox = document.getElementById('toggle_all_permissions');
                        var permissionCheckboxes = document.querySelectorAll('.permission-checkbox');

                        toggleAllCheckbox.addEventListener('change', function () {
                            permissionCheckboxes.forEach(function (checkbox) {
                                checkbox.checked = toggleAllCheckbox.checked;
                            });
                        });

                        permissionCheckboxes.forEach(function (checkbox) {
                            checkbox.addEventListener('change', function () {
                                var allChecked = true;
                                permissionCheckboxes.forEach(function (checkbox) {
                                    if (!checkbox.checked) {
                                        allChecked = false;
                                    }
                                });
                                toggleAllCheckbox.checked = allChecked;
                            });
                        });
                    });
                </script>
            </div>

            <div class="mb-6">
                <x-outline-button href="{{ URL::previous() }}">
                    Go back
                </x-outline-button>
                <button type="submit"
                        class = 'text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800'>

                        Save
                </button>

            </div>
        </form>
    </div>
</div>
@endsection
