<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form method="post" action="{{ url('users/'.$user->id) }}" class="mt-6 space-y-6">
        @csrf
        @method('PUT')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="block w-full mt-1" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="block w-full mt-1" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                </div>

        <div>
            <x-input-label :value="__('User Roles')" />
            <div class="grid grid-cols-4 gap-4">
                @foreach ($roles as $role)
                <div class="flex items-center">
                    <input
                        type="checkbox"
                        id="permission_{{ $role->id }}"
                        name="roles[]"
                        value="{{ $role->name }}"
                        class="mr-2"
                        {{ in_array($role->id, $userRoles) ? 'checked' : '' }}
                    >
                    <label for="permission_{{ $role->id }}">{{ $role->name }}</label>
                </div>
                @endforeach
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('roles')" />
        </div>

        <div class="flex items-center gap-4">
            @if (auth()->user()->hasRole('super-admin'))
            <button>{{ __('Save') }}</button>
            @endif

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
