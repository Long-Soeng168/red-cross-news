@extends('admin.layouts.admin')

@section('content')
<div class="p-4">
    <x-form-header :value="__('Create User')" />
    <form class="w-full" action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid md:grid-cols-2 md:gap-6">
            <!-- Name Address -->
            <div>
                <x-input-label for="name" :value="__('Name')" /><span class="text-red-500">*</span>
                <x-text-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" /><span class="text-red-500">*</span>
                <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
        </div>
        <div class="grid pt-4 md:grid-cols-2 md:gap-6">
            {{-- Password --}}
            <div>
                <x-input-label for="password" :value="__('Password')" /><span class="text-red-500">*</span>

                <x-text-input id="password" class="block w-full mt-1" type="password" name="password" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" /><span class="text-red-500">*</span>

                <x-text-input id="password_confirmation" class="block w-full mt-1" type="password" name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="grid mt-4 md:grid-cols-3 md:gap-6">
            <div>
                <x-input-label for="phone" :value="__('Phone')" />
                <x-text-input id="phone" class="block w-full mt-1" type="text" name="phone" :value="old('phone')"  autofocus placeholder="Phone Number" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <x-input-label for="genders" :value="__('Gender')" />
                <x-select-option id="genders" name='gender'>
                    <option>Male</option>
                    <option>Female</option>
                </x-select-option>
            </div>
            <div>
                <x-input-label for="date_of_birth" :value="__('Date Of Birth')" />
                <x-text-input id="date_of_birth" class="block w-full mt-1" type="date" name="date_of_birth" :value="old('date_of_birth')" autofocus />
                <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
            </div>
        </div>

        <div class="mb-6">
            <div class="flex items-center space-4">
                <div class="max-w-40">
                    <img id="selected-image" src="#" alt="Selected Image" class="hidden max-w-full pr-4 max-h-40" />
                </div>
                <div class="flex-1">
                    <x-input-label for="types" :value="__('Upload Image (max : 2MB)')" />
                    <x-file-input id="dropzone-file" name="image" accept="image/png, image/jpeg, image/gif" onchange="displaySelectedImage(event)" />
                </div>
            </div>
        </div>
        <div class="grid md:grid-cols-2 md:gap-6">
            {{-- Started At --}}
            <div>
                <x-input-label for="started_at" :value="__('Started At')" /><span class="text-red-500">*</span>

                <x-text-input id="started_at" class="block w-full mt-1" type="date" name="started_at" value="{{ old('started_at', \Carbon\Carbon::today()->toDateString()) }}" />

                <x-input-error :messages="$errors->get('started_at')" class="mt-2" />
            </div>

            <!-- Expired At -->
            <div>
                <x-input-label for="expired_at" :value="__('Expired At')" /><span class="text-red-500">*</span>

                <x-text-input id="expired_at" class="block w-full mt-1" type="date" name="expired_at" value="{{ old('expired_at') }}"/>

                <x-input-error :messages="$errors->get('expired_at')" class="mt-2" />
            </div>
        </div>



        <div class="mt-4 mb-6">
            <x-input-label for="password_confirmation" :value="__('Give Role')" /><span class="text-red-500">*</span>

            <div class="grid grid-cols-4 gap-4">
                @foreach ($roles as $role)
                    @if ($role->name == 'super-admin' && !auth()->user()->hasRole('super-admin'))
                        @continue
                    @endif
                    <div class="flex items-center">
                        <input
                            type="checkbox"
                            id="permission_{{ $role->id }}"
                            name="roles[]"
                            value="{{ $role->name }}"
                            class="mr-2"
                            {{-- {{ in_array($permission->id, $rolePermissions) ? "checked" : '' }} --}}
                        >
                        <label class="text-slate-800 dark:text-white" for="permission_{{ $role->id }}">{{ $role->name }}</label>
                    </div>
                @endforeach
            </div>
            <x-input-error :messages="$errors->get('roles')" class="mt-2" />
        </div>

        <div>
            <x-outline-button href="{{ URL::previous() }}">
                Go back
            </x-outline-button>
            <x-submit-button>
                Submit
            </x-submit-button>
        </div>
    </form>


</div>

<script>
    function displaySelectedImage(event) {
        const fileInput = event.target;
        const file = fileInput.files[0];
        const imgElement = document.getElementById('selected-image');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imgElement.src = e.target.result;
                imgElement.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            imgElement.src = "#";
            imgElement.classList.add('hidden');
        }
    }

</script>
@endsection
