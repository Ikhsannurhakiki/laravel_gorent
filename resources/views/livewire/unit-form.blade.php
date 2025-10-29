<div>
    {{ $title = '' }}
    @push('style')
        <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
        <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
            rel="stylesheet" />
    @endpush

    <div id="unitModal" x-data x-show="$store.unitModal.open" x-cloak wire:ignore.self>
        <div x-show="$store.unitModal.open"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 overflow-y-auto">
            <div x-show="$store.unitModal.open" x-transition.opacity.scale
                class="bg-white rounded-xl shadow-lg w-full max-w-lg max-h-[90vh] overflow-y-auto">

                <!-- HEADER -->
                <div class="flex justify-between rounded-t-md items-center p-4 border-b mb-3.5 bg-green-300">
                    <h3 x-data class="text-xl font-semibold text-gray-900 tracking-tight">
                        <template x-if="$store.unitModal.step === 1">
                            <span>Basic Info</span>
                        </template>
                        <template x-if="$store.unitModal.step === 2">
                            <span>Upload Image</span>
                        </template>
                        <template x-if="$store.unitModal.step === 3">
                            <span>Specifications</span>
                        </template>
                    </h3>

                    <button type="button" @click="$store.unitModal.reset(); $dispatch('closeunitmodal')"
                        class="text-black hover:text-red-500 transition">
                        ✕
                    </button>
                </div>

                <div class="p-6">
                    <form wire:submit.prevent="createUnit" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <!-- STEP 1: Basic Info -->
                        <div x-show="$store.unitModal.step === 1" x-transition>
                            <div class="grid grid-cols-3 gap-4">
                                <div class="col-span-1">
                                    <label for="name" class="block mb-2 text-sm font-medium">Name</label>
                                    <input type="text" id="name" wire:model.defer="name"
                                        class="w-full border rounded p-2.5 text-sm" placeholder="Unit name" required>
                                </div>

                                <div class="col-span-1">
                                    <label for="type" class="block mb-2 text-sm font-medium">Type</label>
                                    <select id="type" wire:model.defer="type"
                                        class="w-full border rounded p-2.5 text-sm">
                                        <option value="">Select Type</option>
                                        <option value="car">Car</option>
                                        <option value="motorcycle">Motorcycle</option>
                                        <option value="van">Van</option>
                                        <option value="truck">Truck</option>
                                    </select>
                                </div>

                                <div class="col-span-1">
                                    <label for="pricePerDay" class="block mb-2 text-sm font-medium">Price / Day</label>
                                    <input type="number" id="pricePerDay" wire:model.defer="pricePerDay" min="0"
                                        step="0.01" class="w-full border rounded p-2.5 text-sm" placeholder="Price"
                                        required>
                                </div>

                                <div class="col-span-3">
                                    <label for="description" class="block mb-2 text-sm font-medium">Description</label>
                                    <textarea id="description" wire:model.defer="description" rows="3" class="w-full border rounded p-2.5 text-sm"
                                        placeholder="Write description"></textarea>
                                </div>

                                <div class="col-span-3 flex items-center space-x-2">
                                    <input type="checkbox" id="isAvailable" wire:model.defer="isAvailable"
                                        class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                                    <label for="isAvailable" class="text-sm font-medium text-gray-900">
                                        Available for rent
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- STEP 2: Image Upload -->
                        <div x-show="$store.unitModal.step === 2" x-transition wire:ignore>
                            <label class="block text-sm font-medium mb-2">Thumbnail</label>
                            <div x-data="filepondComponent()" x-init="initFilePond()" x-cloak>
                                <input type="file" x-ref="input" id="thumbnail" name="thumbnail" accept="image/*" />
                                {{-- <p class="text-sm text-gray-500">Upload a thumbnail (max 2MB)</p> --}}
                            </div>
                            <label for="images"
                                class="block mt-4 mb-2 text-sm font-medium text-gray-900">Images</label>
                            <input type="file" name="images[]" id="images" multiple accept="image/*" />
                            {{-- <label class="text-sm text-gray-500 ">You can upload multiple images at once.</label> --}}
                        </div>

                        <!-- STEP 3: Car Specifications -->
                        <div x-show="$store.unitModal.step === 3" x-transition>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="seats" class="block mb-1 text-sm font-medium">Seats</label>
                                    <input type="number" id="seats" wire:model.defer="seats"
                                        class="w-full border rounded p-2.5 text-sm" min="1"
                                        placeholder="e.g., 4">
                                </div>
                                <div>
                                    <label for="engine" class="block mb-1 text-sm font-medium">Engine</label>
                                    <input type="text" id="engine" wire:model.defer="engine"
                                        class="w-full border rounded p-2.5 text-sm" placeholder="e.g., 2000cc">
                                </div>
                                <div>
                                    <label for="transmission"
                                        class="block mb-1 text-sm font-medium">Transmission</label>
                                    <select id="transmission" wire:model.defer="transmission"
                                        class="w-full border rounded p-2.5 text-sm">
                                        <option value="">Select</option>
                                        <option value="manual">Manual</option>
                                        <option value="automatic">Automatic</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="fuel" class="block mb-1 text-sm font-medium">Fuel Type</label>
                                    <select id="fuel" wire:model.defer="fuel"
                                        class="w-full border rounded p-2.5 text-sm">
                                        <option value="">Select</option>
                                        <option value="gasoline">Gasoline</option>
                                        <option value="diesel">Diesel</option>
                                        <option value="electric">Electric</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- FOOTER BUTTONS -->
                        <div class="flex justify-between mt-6">
                            <button type="button" x-show="$store.unitModal.step > 1"
                                @click="$store.unitModal.prev()"
                                class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                                Back
                            </button>

                            <button type="button" x-show="$store.unitModal.step < 3"
                                @click="$store.unitModal.next()"
                                class="ml-auto px-4 py-2 bg-green-300 hover:bg-green-400 rounded">
                                Next
                            </button>

                            <button wire:click="createUnit" x-show="$store.unitModal.step === 3"
                                class="ml-auto px-5 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @push('script')
        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>
        <script src="https://unpkg.com/filepond@^4/dist/filepond.min.js"></script>

        <script>
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
                                            .upload('thumbnail', file, load, error, progress);
                                    }
                                },
                                revert: (filename, load) => {
                                    const livewireComponent = this.$root.closest('[wire\\:id]');
                                    if (livewireComponent) {
                                        Livewire.find(livewireComponent.getAttribute('wire:id'))
                                            .removeUpload('thumbnail', filename, load);
                                    }
                                }
                            }
                        });

                        // reset on modal close
                        window.addEventListener('closeunitmodal', () => {
                            if (this.pond) this.pond.removeFiles();
                        });
                    }
                }
            }

            function thumbnailEditor(existingThumbnail = '') {
                return {
                    isEdit: false,
                    editing: false,
                    thumbnailUrl: existingThumbnail,

                    enableEdit() {
                        this.editing = true;
                    }
                }
            }
        </script>
    @endpush
