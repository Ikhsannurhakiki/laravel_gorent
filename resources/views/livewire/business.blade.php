    @php
        $title = 'Create Business';
        $sTitle = $title === 'Create New Branch' ? 'Branch' : 'Business';
    @endphp

    <div id="createBusiness" x-data="{ open: false }" x-on:opencreatebusiness.window="open = true"
        x-on:closemodal.window="open = false" x-on:keepmodalopen.window="open = true" x-init="Livewire.on('validationFailed', () => open = true);
        Livewire.on('businessCreated', () => open = false);" x-show="open"
        x-transition.opacity.scale.80 x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm transition-opacity duration-300">


        <div
            class="relative bg-white rounded-2xl shadow-2xl w-full max-w-2xl p-8 transform transition-all scale-95 opacity-0 animate-[fadeIn_0.3s_ease-out_forwards]">
            <!-- Header -->
            <div class="flex justify-between items-center border-b pb-4 mb-6">
                <h3 class="text-xl font-semibold text-gray-900 tracking-tight">{{ $title }}</h3>
                <button type="button" data-modal-hide="createBusiness" wire:click="$dispatch('closemodal')"
                    class="text-gray-400 hover:text-red-500 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Form -->
            <form wire:submit.prevent="createBusiness" class="space-y-6">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                        <input wire:model="name" id="name" type="text"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500">
                        @error('name')
                            <span class="text-xs text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input wire:model="email" id="email" type="email"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500">
                        @error('email')
                            <span class="text-xs text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                        <input wire:model="phone" id="phone" type="text"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500">
                        @error('phone')
                            <span class="text-xs text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                    <textarea wire:model="address" id="address" rows="3"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500"></textarea>
                    @error('address')
                        <span class="text-xs text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- FilePond Input -->
                <div wire:ignore class=" sm:col-span-3  "><label for="logo"
                        class="block mb-2 text-sm font-medium text-gray-900 ">Logo</label>
                    <input
                        class ="@error('avatar') max-h-2 bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 @enderror"
                        type="file" name="logo" id="logo" accept="image/*" aria-describedby="logo_help"
                        accept="image/png, image/jpg, image/jpeg" />
                    <div class=" text-sm text-gray-500" id="logo_help">.png, .jpg, .jpeg (MAX. 2MB).</div>
                    @error('logo')
                        <p class=" text-sm text-red-600"><span class="font-medium">Oh, snapp!</span>
                            {{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit -->
                <div class="flex justify-center pt-4">
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-medium px-6 py-2.5 rounded-lg shadow-md transition focus:ring-2 focus:ring-green-400 focus:ring-offset-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 inline-block mr-1.5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Add {{ Str::lower($sTitle) }}
                    </button>
                </div>
            </form>
        </div>
        </>

        @push('style')
            {{-- FilePond styles --}}
            <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
            <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
                rel="stylesheet" />
        @endpush

        @push('script')
            {{-- FilePond scripts --}}
            <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
            <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
            <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
            <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>

            <style>
                @keyframes fadeIn {
                    from {
                        opacity: 0;
                        transform: scale(0.95);
                    }

                    to {
                        opacity: 1;
                        transform: scale(1);
                    }
                }
            </style>

            <script>
                // Initialize FilePond with plugins
                FilePond.registerPlugin(
                    FilePondPluginImagePreview,
                    FilePondPluginFileValidateType,
                    FilePondPluginFileValidateSize
                );

                // Create FilePond instance
                const inputElement = document.querySelector('input[id="logo"]');
                const pond = FilePond.create(inputElement, {
                    acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg'],
                    maxFileSize: '2MB',
                    labelIdle: 'Drag & Drop your logo or <span class="filepond--label-action">Browse</span>',
                    // stylePanelAspectRatio: 1,
                    credits: false,
                    server: {
                        process: '/upload',
                        revert: null,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }
                });
            </script>
        @endpush
