<div id="createBusiness" wire:ignore.self>
    <div x-data x-show="$store.modal.open" x-transition.opacity.scale.80 x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm transition-opacity duration-300">
        <div
            class="relative bg-white rounded-2xl shadow-2xl w-full max-w-2xl  transform transition-all scale-95 opacity-0 animate-[fadeIn_0.3s_ease-out_forwards]">
            <!-- Header -->
            <div class="flex justify-between rounded-t-md items-center p-4 border-b mb-3.5 bg-green-300">
                <h3 class="text-xl font-semibold text-gray-900 tracking-tight">
                    <span x-text="$store . modal . isEdit ? 'Edit Business' : 'Create Business'""></span>
                </h3>
                <button type="button" wire:click="$dispatch('closemodal')"
                    class="text-black hover:text-red-500 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Form -->
            <div class = "p-8">
                <form wire:submit.prevent="submitBusiness" class="space-y-6">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                        <div class="sm:col-span-3">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                            <input wire:model="name" id="name" type="text"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500">
                            @error('name')
                                <span class="text-xs text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                        <div class="sm:col-span-2">
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

                        <div class="sm:col-span-2 sm:row-span-1">
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                            <textarea wire:model="address" id="address" rows="5"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500 resize-none"></textarea>
                            @error('address')
                                <span class="text-xs text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="sm:col-span-1 sm:row-span-2" x-data="logoEditor('{{ $existingLogoPath }}')" x-init="$watch('$store.modal.isEdit', value => isEdit = value);">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Logo</label>

                            <!-- Image preview with edit button -->
                            <template x-if="isEdit && !editing">
                                <div
                                    class="relative w-full h-32 border rounded-lg overflow-hidden flex items-center justify-center bg-[#F1F0EF] mb-3">
                                    <img x-bind:src="$wire.existingLogoPath"
                                        class="mx-auto w-24 h-24 rounded-full shadow-lg object-cover"
                                        alt="{{ $name }} logo">
                                    <button type="button" @click="enableEdit()"
                                        class="absolute top-1 right-1 bg-white rounded-full p-1 shadow hover:bg-gray-200">
                                        <!-- Pencil Icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487 18.549 2.8a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z" />
                                        </svg>
                                    </button>
                                </div>
                            </template>

                            <!-- FilePond input -->
                            <div x-show="!isEdit || editing" x-data="filepondComponent()" x-init="initFilePond()" x-cloak>
                                <input type="file" x-ref="input" name="logo" wire:model="logo" />
                            </div>
                        </div>


                    </div>

                    <div class="sm:col-span-2 sm:row-start-2 sm:row-span-1 flex justify-center items-start">
                        <button type="submit"
                            class="w-full sm:w-auto bg-green-300 hover:bg-green-500 text-blakc font-medium px-6 py-2.5 rounded-lg shadow-md transition focus:ring-2 focus:ring-green-400 focus:ring-offset-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 inline-block mr-1.5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            <span x-text=" $store.modal.isEdit ? 'Update Business' : 'Add Business'"></span>

                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('script')
    <link href="https://unpkg.com/filepond@^4/dist/filepond.min.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview@^4/dist/filepond-plugin-image-preview.min.css"
        rel="stylesheet">

    <script src="https://unpkg.com/filepond@^4/dist/filepond.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview@^4/dist/filepond-plugin-image-preview.min.js"></script>

    <script>
        function filepondComponent() {
            return {
                pond: null,
                hookRegistered: false,
                initFilePond() {
                    FilePond.registerPlugin(FilePondPluginImagePreview);
                    this.createPond();

                    if (!this.hookRegistered) {
                        Livewire.hook('morph.updated', () => {
                            if (!this.$refs.input._pond) {
                                this.createPond();
                            }
                        });
                        this.hookRegistered = true;
                    }

                    window.addEventListener('closemodal', () => {
                        if (this.pond) this.pond.removeFiles();
                    });
                },
                createPond() {
                    if (this.pond) this.pond.destroy();

                    this.pond = FilePond.create(this.$refs.input, {
                        allowImagePreview: true,
                        imagePreviewHeight: 120,
                        server: {
                            process: (fieldName, file, metadata, load, error, progress, abort) => {
                                this.$wire.upload('logo', file, load, error, progress);
                            },
                            revert: (filename, load) => {
                                this.$wire.removeUpload('logo', filename, load);
                            }
                        },
                    });
                }
            }
        }


        function logoEditor(existingLogo = '') {
            return {
                isEdit: false, // set via x-init from $store.modal.isEdit
                editing: false, // false initially → show image first
                logoUrl: existingLogo,
                enableEdit() {
                    this.editing = true; // show FilePond
                }
            }
        }
    </script>



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
