<div class="relative">
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
        <div class="grid gap-5 mb-5 lg:grid-cols-2">
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
        </div>
        <div class="grid grid-cols-2 gap-5 mb-5 lg:grid-cols-3">
            <!-- Start Name -->
            <div class="">
                <x-input-label for="primary" :value="__('Main Color')" /><span class="text-red-500">*</span>
                <input type="color" class="block w-full mt-1" wire:model='primary'>
                <x-input-error :messages="$errors->get('primary')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="primary_hover" :value="__('Hover Color')" /><span class="text-red-500">*</span>
                    <input type="color" class="block w-full mt-1" wire:model='primary_hover'>
                    <x-input-error :messages="$errors->get('primary_hover')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="banner_color" :value="__('Banner Color')" /><span class="text-red-500">*</span>
                        <input type="color" class="block w-full mt-1" wire:model='banner_color'>
                        <x-input-error :messages="$errors->get('banner_color')" class="mt-2" />
                        </div>
            </div>

            <div class="grid grid-cols-2 gap-5 mb-5 lg:grid-cols-3">
            <div>
                <x-input-label for="show_bg_menu" :value="__('Menu Background')" />
                <span class="text-red-500">* </span>
                <!-- Switch/Toggle -->
                <label class="flex items-center mt-1 cursor-pointer">
                    <input type="checkbox" class="sr-only peer" wire:model='show_bg_menu'>
                    <span class="text-sm text-gray-400 dark:text-gray-300">Off</span>
                    <div class="mx-2 relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:w-5 after:h-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    <span class="text-sm text-gray-400 dark:text-gray-300">On</span>
                </label>
                <!-- End Switch/Toggle -->
                <x-input-error :messages="$errors->get('show_bg_menu')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="pdf_viewer_default" :value="__('PDF Viewer')" />
                <span class="text-red-500">* </span>
                <!-- Switch/Toggle -->
                <label class="flex items-center mt-1 cursor-pointer">
                    <input type="checkbox" class="sr-only peer" wire:model='pdf_viewer_default'>
                    <span class="text-sm text-gray-400 dark:text-gray-300">Custom</span>
                    <div class="mx-2 relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:w-5 after:h-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    <span class="text-sm text-gray-400 dark:text-gray-300">Default</span>
                </label>
                <!-- End Switch/Toggle -->
                <x-input-error :messages="$errors->get('pdf_viewer_default')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="show_download_button" :value="__('Show Button Download')" />
                <span class="text-red-500">* </span>
                <!-- Switch/Toggle -->
                <label class="flex items-center mt-1 cursor-pointer">
                    <input type="checkbox" class="sr-only peer" wire:model='show_download_button'>
                    <span class="text-sm text-gray-400 dark:text-gray-300">Don't Show</span>
                    <div class="mx-2 relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:w-5 after:h-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    <span class="text-sm text-gray-400 dark:text-gray-300">Show</span>
                </label>
                <!-- End Switch/Toggle -->
                <x-input-error :messages="$errors->get('show_download_button')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="check_ip_range" :value="__('Check IP Range')" />
                <span class="text-red-500">* </span>
                <!-- Switch/Toggle -->
                <label class="flex items-center mt-1 cursor-pointer">
                    <input type="checkbox" class="sr-only peer" wire:model='check_ip_range'>
                    <span class="text-sm text-gray-400 dark:text-gray-300">Don't Check</span>
                    <div class="mx-2 relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:w-5 after:h-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    <span class="text-sm text-gray-400 dark:text-gray-300">Check IP</span>
                </label>
                <!-- End Switch/Toggle -->
                <x-input-error :messages="$errors->get('check_ip_range')" class="mt-2" />
            </div>
            <div class="col-span-2">
                <x-input-label for="ip_range" :value="__('IP Range')" />
                <span class="text-yellow-600">Ex : 192.168.1.0/24<span class="text-2xl font-bold">,</span>203.144.68.205 (Add More by <span class="text-2xl font-bold">,</span> symbol)</span>
                <x-text-input id="ip_range" class="block w-full mt-1" type="text" name="ip_range" wire:model='ip_range'
                    required autofocus placeholder="Ex : 192.168.1.0/24,203.144.68.205 (Add More by , symbol)" />
                <span class="text-gray-400">'192.168.1.0/24',   // IP range for 192.168.1.0 -> 192.168.1.255</span>
                <x-input-error :messages="$errors->get('ip_range')" class="mt-2" />
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

        {{-- Start Logo --}}
        <div class="mb-5">
            {{-- Start Image Upload --}}
            <div class="items-center gap-5 mb-5 lg:flex space-4" wire:key='uploadimage'>

                <div class="flex flex-col flex-1">
                    <label class='mb-4 text-sm font-medium text-gray-600 dark:text-white'>
                        Upload Logo (Max: 2MB) (Recommend : 1x1 or 512x512 pixels)<span class="text-red-500">*</span>
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
                                <p class="text-xs text-gray-500 dark:text-gray-400">PNG (MAX. 2MB)</p>

                            </div>
                            <input wire:model="image" accept="image/png" id="dropzone-file"
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
                @if ($image)
                    <div class="flex-1 pt-5">
                        <img src="{{ $image->temporaryUrl() }}" alt="Logo Image"
                            class="object-contain max-w-full pr-4 max-h-40" />
                    </div>
                @elseif($item->image)
                    <div class="flex-1 pt-5">
                        <img src="{{ asset('assets/images/website_infos/'.$item->image) }}" alt="Logo Image"
                            class="object-contain max-w-full pr-4 max-h-40" />
                    </div>
                @endif
            </div>
            {{-- End Image Upload --}}
        </div>
        {{-- End Logo --}}

        {{-- Start Banner --}}
        <div class="mb-5">
            {{-- Start Image Upload --}}
            <div class="items-center gap-5 mb-5 lg:flex space-4" wire:key='uploadbanner'>
                <div class="flex flex-col flex-1">
                    <label class='mb-4 text-sm font-medium text-gray-600 dark:text-white'>
                        Upload Banner (Max: 2MB) (Recommend : 40x9 or 1440x324 pixels) <span class="text-red-500">*</span>
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
                                <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG or GIF (MAX. 2MB)</p>

                            </div>
                            <input wire:model="banner" accept="image/png, image/jpeg, image/gif" id="dropzone-file"
                                type="file" class="absolute h-[140%] w-[100%]" />
                        </label>
                    </div>
                    <div wire:loading wire:target="banner" class="text-blue-700">
                        <span>
                            <img class="inline w-6 h-6 text-white me-2 animate-spin" src="{{ asset('assets/images/reload.png') }}" alt="reload-icon">
                            Uploading...
                        </span>
                    </div>
                    <x-input-error :messages="$errors->get('banner')" class="mt-2" />
                </div>
                @if ($banner)
                    <div class="flex-1 pt-5">
                        <img src="{{ $banner->temporaryUrl() }}" alt="Banner Image"
                            class="object-contain max-w-full max-h-40" />
                    </div>
                @elseif($item->banner)
                    <div class="flex-1 pt-5">
                        <img src="{{ asset('assets/images/website_infos/'.$item->banner) }}" alt="Banner Image"
                            class="object-contain w-full max-h-40" />
                    </div>
                @endif
            </div>
            {{-- End Image Upload --}}

        </div>
        {{-- End Banner --}}

        <div class="absolute bottom-0 right-0 flex items-center justify-center gap-2 text-blue-600 hover:underline dark:text-white">
            <a target="_blank" href="https://www.canva.com/design/DAGLu5qz3w4/0sg-8UOUVqHCp_JIyXUMlw/view?utm_content=DAGLu5qz3w4&utm_campaign=designshare&utm_medium=link&utm_source=publishsharelink&mode=preview">Banner Template</a>
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-arrow-out-up-right">
                <path d="M21 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h6"></path>
                <path d="m21 3-9 9"></path>
                <path d="M15 3h6v6"></path>
            </svg>
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
            {{-- <x-outline-button wire:ignore href="{{ URL::previous() }}">
                Go back
            </x-outline-button> --}}
            @can('update setting')
            <button wire:click.prevent="save"
                    wire:target="save"
                    wire:loading.attr="disabled"
                    class = 'text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800'>

                    Save Update
            </button>
            @endcan

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
