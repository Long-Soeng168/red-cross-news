<div class="pt-5 flex w-full gap-5 items-center">
    <form action="{{ route('admin.settings.store') }}" method="POST" class="space-y-3 w-full">
        @csrf
        <div class="grid md:grid-cols-2 md:gap-6 mt-4">
            <div>
                <x-input-label for="name" :value="__('Name')" /><span class="text-red-500">*</span>
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$shop->name" required autofocus placeholder="Name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="phone" :value="__('Phone')" />
                <x-text-input id="phone" class="block mt-1 w-full" type="number" name="phone" :value="$shop->phone"  placeholder="Phone Number" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>
        </div>

        <div class="mb-5">
            <div class="flex items-center space-4">
                <div class="max-w-40">
                    <img id="selected-image" src="#" alt="Selected Image" class="hidden max-w-full max-h-40 pr-4" />
                </div>
                <div class="flex-1">
                    <x-input-label for="types" :value="__('Shop Logo (max : 2MB)')" />
                    <x-file-input id="dropzone-file" type="file" name="image" accept="image/png, image/jpeg, image/gif" onchange="displaySelectedImage(event)" />
                </div>
            </div>
        </div>

        <div>
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="$shop->address" placeholder="Shop Address" />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <div class="pt-2">
            <x-submit-button>
                Save Changes
            </x-submit-button>
        </div>
    </form>
</div>
