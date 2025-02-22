<div>
    @if (session('success'))
        <div class="fixed top-[5rem] right-4 z-[999999] " wire:key="{{ rand() }}" x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 7000)">
            <div x-show="show" id="alert-2"
                class="flex items-center p-4 mb-4 text-green-800 border border-green-500 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <div class="ml-2">
                    {{ session('success') }}
                </div>
                <button type="button" @click="show = false"
                    class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#alert-2" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        {{-- @dd(session()->has('error')) --}}
        <div class="fixed top-[5rem] right-4 z-[999999] " wire:key="{{ rand() }}" x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 7000)">
            <div x-show="show" id="alert-2"
                class="flex items-center p-4 mb-4 text-red-800 border border-red-500 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <div class="ml-2">
                    @foreach (session('error') as $error)
                        <div class="text-sm font-medium ms-3">
                            - {{ $error }}
                        </div>
                    @endforeach

                    {{ session()->forget('errors') }}



                </div>
                <button type="button" @click="show = false"
                    class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#alert-2" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        </div>
    @endif
    <form class="w-full" action="{{ route('admin.items.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid mb-5 lg:grid-cols-2 lg:gap-6">
            <!-- Start Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" /><span class="text-red-500">*</span>
                <x-text-input id="name" class="block w-full mt-1" type="text" name="name" wire:model='name'
                    required autofocus placeholder="Name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="name_kh" :value="__('Name KH')" /><span class="text-red-500">*</span>
                <x-text-input id="name_kh" class="block w-full mt-1" type="text" name="name_kh" wire:model='name_kh'
                    required autofocus placeholder="Name KH" />
                <x-input-error :messages="$errors->get('name_kh')" class="mt-2" />
            </div>
            <div class="col-span-1">
                <label for="order_index" class = 'mb-4 text-sm font-medium text-gray-600 dark:text-white'>
                   {{ __('Order Index') }}
                </label>
                <x-text-input id="order_index" class="block w-full mt-1" type="number" name="order_index" wire:model='order_index'
                    required autofocus placeholder="Order Index" />
                <x-input-error :messages="$errors->get('order_index')" class="mt-2" />
            </div>
            <div class="col-span-1">
                <label for="link" class = 'mb-4 text-sm font-medium text-gray-600 dark:text-white'>
                   {{ __('Link') }}
                </label>
                <x-text-input id="link" class="block w-full mt-1" type="text" name="link" wire:model='link'
                    required autofocus placeholder="Link or URL" />
                <x-input-error :messages="$errors->get('link')" class="mt-2" />
            </div>
            <!-- End Name -->

        </div>

        {{-- <div class="grid gap-5 mb-5 lg:grid-cols-2 lg:gap-6">
            <!-- Start Pages -->
            <div>
                <x-input-label for="pages_count" :value="__('Pages')" />
                <x-text-input id="pages_count" class="block w-full" type="number" name="pages_count"
                    wire:model='pages_count' autofocus placeholder="Number of Pages" />
                <x-input-error :messages="$errors->get('pages_count')" class="mt-2" />
            </div>
            <!-- End Pages -->

            <!-- Start Edition -->
            <div>
                <x-input-label for="edition" :value="__('Edition')" />
                <x-text-input id="edition" class="block w-full" type="number" name="edition" wire:model='edition'
                    autofocus placeholder="Edition" />
                <x-input-error :messages="$errors->get('edition')" class="mt-2" />
            </div>
            <!-- End Edition -->

            <!-- Start isbn -->
            <div>
                <x-input-label for="isbn" :value="__('ISBN')" />
                <x-text-input id="isbn" class="block w-full" type="text" name="isbn" wire:model='isbn'
                    placeholder="ISBN" />
                <x-input-error :messages="$errors->get('isbn')" class="mt-2" />
            </div>
            <!-- End isbn -->

            <!-- Start Link -->
            <div>
                <x-input-label for="link" :value="__('Link')" />
                <x-text-input id="link" class="block w-full" type="text" name="link" wire:model='link'
                    placeholder="Link" />
                <x-input-error :messages="$errors->get('link')" class="mt-2" />
            </div>
            <!-- End Link -->
        </div> --}}

        <div class="mb-5">
            {{-- Start Image Upload --}}
            <div class="flex items-center mb-5 space-4" wire:key='uploadimage'>
                @if ($image)
                    <div class="pt-5 max-w-40">
                        <img src="{{ $image->temporaryUrl() }}" alt="Selected Image"
                            class="max-w-full pr-4 max-h-40" />
                    </div>
                @elseif($item->image)
                    <div class="pt-5 max-w-40">
                        <img src="{{ asset('assets/images/links/'.$item->image) }}" alt="Selected Image"
                            class="max-w-full pr-4 max-h-40" />
                    </div>
                @endif
                <div class="flex flex-col flex-1">
                    <label class='mb-4 text-sm font-medium text-gray-600 dark:text-white'>
                        Upload Image (Max: 2MB) (Recommend : 1x1 or 512x512 pixels) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative flex items-center justify-center w-full -mt-3 overflow-hidden">
                        <label for="dropzone-file"
                            class="flex flex-col items-center justify-center w-full h-40 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                        class="font-semibold">Click to upload</span> or drag and drop</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 2MB)</p>

                            </div>
                            <input wire:model="image" accept="image/png, image/jpeg, image/gif" id="dropzone-file"
                                type="file" class="absolute h-[140%] w-[100%]" />
                        </label>
                    </div>
                    <div wire:loading wire:target="image" class="text-blue-700">
                        <span>
                            <img class="inline w-6 h-6 text-white me-2 animate-spin" src="{{ asset('assets/images/reload.png') }}" alt="reload-icon">
                            Uploading...
                        </span>
                    </div>
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>
            </div>
            {{-- End Image Upload --}}
        </div>

        {{-- <div class="mb-5" wire:ignore>
            <x-input-label for="description" :value="__('Description')" />
            <textarea id="description" name="description"></textarea>
        </div>
        <div class="mb-5" wire:ignore>
            <x-input-label for="description_kh" :value="__('Description KH')" />
            <textarea id="description_kh" name="description_kh"></textarea>
        </div> --}}

        <div>
            <x-outline-button wire:ignore href="{{ URL::previous() }}">
                Go back
            </x-outline-button>
            <button wire:click.prevent="save"
                    wire:target="save"
                    wire:loading.attr="disabled"
                    class = 'text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800'>

                    Save
            </button>
            <span wire:target="save" wire:loading>
                <img class="inline w-6 h-6 text-white me-2 animate-spin" src="{{ asset('assets/images/reload.png') }}" alt="reload-icon">
                Saving
            </span>

        </div>
    </form>

</div>

@script
    <script>
        // let options = {
        //     filebrowserImageBrowseUrl: "{{ asset('laravel-filemanager?type=Images') }}",
        //     filebrowserImageUploadUrl: "{{ asset('laravel-filemanager/upload?type=Images&_token=') }}",
        //     filebrowserBrowseUrl: "{{ asset('laravel-filemanager?type=Files') }}",
        //     filebrowserUploadUrl: "{{ asset('laravel-filemanager/upload?type=Files&_token=') }}"
        // };

        // $(document).ready(function() {
        //     const editor = CKEDITOR.replace('description', options);
        //     editor.on('change', function(event) {
        //         console.log(event.editor.getData())
        //         @this.set('description', event.editor.getData(), false);
        //     })
        // })
        // $(document).ready(function() {
        //     const editor = CKEDITOR.replace('description_kh', options);
        //     editor.on('change', function(event) {
        //         console.log(event.editor.getData())
        //         @this.set('description_kh', event.editor.getData(), false);
        //     })
        // })



        $(document).ready(function() {
            document.addEventListener('livewire:updated', event => {
                console.log('updated'); // Logs 'Livewire component updated' to browser console
                initFlowbite();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        });


    </script>

    {{-- <script>
        document.addEventListener('livewire:loaded', () => {
            initFlowbite();
        });
    </script> --}}
@endscript
