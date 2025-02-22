@extends('admin.layouts.admin')

@section('content')
    <div class="p-4">
        <x-form-header :value="__('Edit User')" class="p-4" />

        <div >
            <div class="w-full mx-auto space-y-6 dark:text-white">
                <div class="p-4 bg-white shadow sm:rounded-lg dark:bg-gray-800">
                    <div class="w-full">
                        @include('admin.users.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="p-4 bg-white shadow sm:rounded-lg dark:bg-gray-800">
                    <div class="w-full">
                        @include('admin.users.partials.update-password-form')
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection

