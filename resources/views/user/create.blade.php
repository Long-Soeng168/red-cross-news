@extends('layouts.default')

@section('content')

<form method="POST" action="{{ url('/users') }}" class="max-w-xl mx-auto bg-white p-6 m-10 rounded-md ">
    @csrf

    <!-- Name -->
    <p class="mb-6 text-center font-bold text-xl">Create User</p>
    <div>
        <x-input-label for="name" :value="__('Name')" />
        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <!-- Email Address -->
    <div class="mt-4">
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <!-- Password -->
    <div class="mt-4">
        <x-input-label for="password" :value="__('Password')" />

        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />

        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <!-- Confirm Password -->
    <div class="mt-4">
        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />

        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
    </div>

    <div class="mt-4">
        <x-input-label for="password_confirmation" :value="__('Give Role')" />

        <div class="grid grid-cols-4 gap-4">
            @foreach ($roles as $role)
            <div class="flex items-center">
                <input
                    type="checkbox"
                    id="permission_{{ $role->id }}"
                    name="roles[]"
                    value="{{ $role->name }}"
                    class="mr-2"
                    {{-- {{ in_array($permission->id, $rolePermissions) ? "checked" : '' }} --}}
                >
                <label for="permission_{{ $role->id }}">{{ $role->name }}</label>
            </div>

            @endforeach
        </div>
        <x-input-error :messages="$errors->get('roles')" class="mt-2" />
    </div>

    <div class="flex items-center justify-end mt-4">

        <x-submit-button class="ms-4">
            {{ __('Create') }}
        </x-submit-button>
    </div>
</form>

@endsection
