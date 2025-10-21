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
                <div class="sm:col-span-3">
                    <!-- Label -->
                    <label for="logo" class="block mb-2 text-sm font-medium text-gray-900">
                        Logo
                    </label>

                    <!-- File input + Preview -->
                    <div class="flex items-start gap-4">
                        <input wire:model="logo" type="file" id="logo" wire:model="logo"
                            accept="image/png, image/jpg, image/jpeg"
                            class="border border-gray-300 rounded-lg shadow-sm px-4 focus:ring-green-500 focus:border-green-500 text-sm file:mr-3 file:py-2 file:px-3 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100" />
                        <div wire:loading wire:target="logo">
                            <div
                                class="flex items-center justify-center w-30 h-30 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
                                <div role="status">
                                    <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin fill-green-500"
                                        viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                            fill="currentColor" />
                                        <path
                                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                            fill="currentFill" />
                                    </svg>
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                        </div>
                        @if ($logo)
                            <img src="{{ $logo->temporaryUrl() }}" alt="Logo Preview"
                                class="w-30 h-30 object-cover rounded-lg shadow-md border border-gray-200" />
                        @endif
                    </div>

                    <!-- Error message -->
                    @error('logo')
                        <span class="text-sm text-red-600 mt-1 block">
                            {{ $message }}
                        </span>
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
        @endpush
