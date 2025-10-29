<div id="businessModal" x-data x-show="$store.modal.open" x-cloak wire:ignore.self x-transition.opacity.scale.80
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm transition-opacity duration-300"
    style="display: none;">

    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-2xl transform transition-all">
        <!-- HEADER -->
        <div class="flex justify-between items-center p-4 border-b mb-3.5 bg-green-300 rounded-t-md">
            <h3 class="text-xl font-semibold text-gray-900 tracking-tight">
                <span x-text="$store.modal.isEdit ? 'Edit Business' : 'Create Business'"></span>
            </h3>
            <button type="button" @click="$dispatch('closemodal')" class="text-black hover:text-red-500 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- FORM -->
        <div class="p-8">
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

                    <div class="sm:col-span-1 sm:row-span-2" x-data="logoEditor('{{ $existingLogoPath }}')" x-init="$watch('$store.modal.isEdit', value => isEdit = value)">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Logo</label>

                        <!-- Existing logo preview (Edit mode, before clicking pencil) -->
                        <template x-if="isEdit && !editing">
                            <div
                                class="relative w-full h-32 border rounded-lg overflow-hidden flex items-center justify-center bg-[#F1F0EF] mb-3">
                                <img x-bind:src="$wire.existingLogoPath"
                                    class="mx-auto w-24 h-24 rounded-full shadow-lg object-cover"
                                    alt="{{ $name }} logo">
                                <button type="button" @click="enableEdit()"
                                    class="absolute top-1 right-1 bg-white rounded-full p-1 shadow hover:bg-gray-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.862 4.487 18.549 2.8a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z" />
                                    </svg>
                                </button>
                            </div>
                        </template>

                        <!-- FilePond uploader (for create or when editing logo) -->
                        <div x-show="!isEdit || editing" wire:ignore x-data="filepondComponent()" x-init="initFilePond()"
                            x-cloak>
                            <input type="file" x-ref="input" name="logo" />
                        </div>
                    </div>



                </div>

                <div class="sm:col-span-2 sm:row-start-2 sm:row-span-1 flex justify-center items-start">
                    <button type="submit"
                        class="w-full sm:w-auto bg-green-300 hover:bg-green-500 text-blakc font-medium px-6 py-2.5 rounded-lg shadow-md transition focus:ring-2 focus:ring-green-400 focus:ring-offset-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 inline-block mr-1.5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        <span x-text=" $store.modal.isEdit ? 'Update Business' : 'Add Business'"></span>

                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('script')
    <script src="https://unpkg.com/filepond@^4/dist/filepond.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview@^4/dist/filepond-plugin-image-preview.min.js"></script>

    <script>
        // 🔹 Alpine component for FilePond
        function filepondComponent() {
            return {
                pond: null,
                initFilePond() {
                    FilePond.registerPlugin(FilePondPluginImagePreview);

                    this.pond = FilePond.create(this.$refs.input, {
                        allowImagePreview: true,
                        imagePreviewHeight: 120,
                        credits: false,
                        server: {
                            process: (fieldName, file, metadata, load, error, progress, abort) => {
                                const livewireComponent = this.$root.closest('[wire\\:id]');
                                if (livewireComponent) {
                                    Livewire.find(livewireComponent.getAttribute('wire:id'))
                                        .upload('logo', file, load, error, progress);
                                }

                            },
                            revert: (filename, load) => {
                                const livewireComponent = this.$root.closest('[wire\\:id]');
                                if (livewireComponent) {
                                    Livewire.find(livewireComponent.getAttribute('wire:id'))
                                        .removeUpload('logo', filename, load);
                                }

                            }
                        }
                    });

                    // 🔹 Reset FilePond files when modal closes
                    window.addEventListener('closemodal', () => {
                        if (this.pond) this.pond.removeFiles();
                    });
                }
            }
        }

        // 🔹 Alpine component for handling edit/view state
        function logoEditor(existingLogo = '') {
            return {
                isEdit: false,
                editing: false,
                logoUrl: existingLogo,
                enableEdit() {
                    this.editing = true;
                }
            }
        }

        // 🔹 Re-init FilePond after Livewire updates (if needed)
        document.addEventListener('livewire:update', () => {
            document.querySelectorAll('input[type=file][x-ref=input]').forEach(input => {
                if (!input._filepond) {
                    FilePond.create(input, {
                        allowImagePreview: true,
                        imagePreviewHeight: 120,
                        credits: false
                    });
                }
            });
        });
    </script>
@endpush
