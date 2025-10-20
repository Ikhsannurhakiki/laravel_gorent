{{ $title = '' }}
@push('style')
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
@endpush

<div id="addUnit" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative p-4 bg-white rounded-lg shadow sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900">{{ $title }}</h3>
                <button type="button" data-modal-hide="createBusiness"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <!-- Modal body -->
            <form action="#" method="POST" enctype="multipart/form-data" class="space-y-6">
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

                    {{-- Multiple Images Upload --}}
                    <div class=" col-span-3">
                        <label for="images" class="block mb-2 text-sm font-medium text-gray-900">Gallery
                            Images</label>
                        <input type="file" name="images[]" id="images" multiple accept="image/*" />
                        <p class="text-sm text-gray-500 mt-1">You can upload multiple images at once.</p>
                    </div>
                    '
                    <div class="col-span-3">
                        <label for="logo" class="block mb-2 text-sm font-medium text-gray-900">Logo</label>
                        <input type="file" name="logo" id="logo" accept="image/*" />
                        <p class="text-sm text-gray-500 mt-1">Upload one logo image (max 2MB)</p>
                    </div>
                </div>

                <div class="flex justify-center space-x-2">
                    <button type="submit"
                        class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('script')
    <!-- ✅ JS includes -->
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

    <script>
        // ✅ Register all plugins
        FilePond.registerPlugin(
            FilePondPluginImagePreview,
            FilePondPluginFileValidateType,
            FilePondPluginFileValidateSize
        );

        // ✅ FilePond for logo (single)
        FilePond.create(document.querySelector('#logo'), {
            acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg'],
            maxFileSize: '2MB',
            labelIdle: '📷 Drag & Drop your logo or <span class="filepond--label-action">Browse</span>',
            allowMultiple: false,
            imagePreviewHeight: 150,
            stylePanelAspectRatio: 1 / 1,
        });

        // ✅ FilePond for gallery (multi)
        FilePond.create(document.querySelector('#images'), {
            acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg'],
            maxFileSize: '2MB',
            allowMultiple: true,
            labelIdle: '🖼 Drag & Drop multiple images or <span class="filepond--label-action">Browse</span>',
            imagePreviewHeight: 120,
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
