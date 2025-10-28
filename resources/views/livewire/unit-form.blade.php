<div>
    {{ $title = '' }}
    @push('style')
        <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
        <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
            rel="stylesheet" />
    @endpush

    <div x-data="{ open: false }" x-cloak x-on:openunitmodalcreate.window="open = true"
        x-on:closeunitmodal.window="open = false">

        <div x-show="open" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 overflow-y-auto">
            <div x-show="open" x-transition.opacity.scale
                class="bg-white rounded-xl shadow-lg w-full max-w-lg max-h-[90vh] overflow-y-auto">

                <div class="flex justify-between rounded-t-md items-center p-4 border-b mb-3.5 bg-green-300">
                    <h3 class="text-xl font-semibold text-gray-900 tracking-tight">
                        Add New Unit
                    </h3>
                    <button wire:click= "openUnitForm" class="text-black hover:text-red-500 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="p-6">
                    <!-- Modal body -->
                    <form wire:submit.prevent="createUnit" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-3 gap-4">
                            {{-- Name --}}
                            <div class="col-span-1">
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                                <input type="text" name="name" id="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                    placeholder="Type name" required>
                            </div>

                            {{-- Email --}}
                            <div class="col-span-1">
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                                <input type="email" name="email" id="email"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                    placeholder="Type email" required>
                            </div>

                            {{-- Phone --}}
                            <div class="col-span-1">
                                <label for="phone" class="block mb-2 text-sm font-medium text-gray-900">Phone</label>
                                <input type="text" name="phone" id="phone"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                    placeholder="Type phone" required>
                            </div>

                            {{-- Description --}}
                            <div class="col-span-3">
                                <label for="description"
                                    class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                                <textarea id="description" name="description" rows="4"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500"
                                    placeholder="Write description here"></textarea>
                            </div>

                            {{-- Logo Upload (Single) --}}
                            <div class="col-span-3">
                                <label for="thumbnail"
                                    class="block mb-2 text-sm font-medium text-gray-900">Thumbnail</label>
                                <input type="file" name="thumbnail" id="thumbnail" accept="image/*" />
                                <p class="text-sm text-gray-500 mt-1">Upload thumbnail image (max 2MB)</p>
                            </div>

                            {{-- Multiple Images Upload --}}
                            {{-- <div class=" col-span-3">
                                <label for="images" class="block mb-2 text-sm font-medium text-gray-900">Gallery
                                    Images</label>
                                <input type="file" name="images[]" id="images" multiple accept="image/*" />
                                <p class="text-sm text-gray-500 mt-1">You can upload multiple images at once.</p>
                            </div> --}}

                        </div>

                        <div class="flex justify-center space-x-2">
                            <button type="submit"
                                class="flex items-center justify-center text-black bg-green-300 hover:bg-green-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1.5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                Submit
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <!-- ✅ JS includes -->
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        // ✅ Register all plugins
        FilePond.registerPlugin(
            FilePondPluginImagePreview,
            FilePondPluginFileValidateType,
            FilePondPluginFileValidateSize
        );

        // ✅ FilePond for logo (single)
        FilePond.create(document.querySelector('#thumbnail'), {
            acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg'],
            maxFileSize: '2MB',
            labelIdle: '📷 Drag & Drop your thumbnail or <span class="filepond--label-action">Browse</span>',
            allowMultiple: false,
        });

        // ✅ Optional: server settings
        FilePond.setOptions({
            credits: false,
            server: {
                process: {
                    url: '#', // replace with your upload route
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                revert: null,
            }
        });
    </script>
@endpush
</div>
