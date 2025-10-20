 @if ($title == 'Create New Branch')
     {{ $sTitle = 'Branch' }}
 @else
     {{ $sTitle = 'Business' }}
 @endif

 @push('style')
     <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
     <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
 @endpush

 <div id="createBusiness" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
     <div class="relative p-4 w-full max-w-2xl max-h-full">
         <!-- Modal content -->
         <div class="relative p-4 bg-white rounded-lg shadow sm:p-5">
             <!-- Modal header -->
             <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                 <h3 class="text-lg font-semibold text-gray-900">{{ $title }}</h3>
                 <button type="button" data-modal-hide="createBusiness"
                     class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
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

             <form action="#" method="POST">
                 <div class="grid grid-cols-3 gap-4 mb-4">
                     <div class="py-2 col-span-1">
                         <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                         <input type="text" name="name" id="name"
                             class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                             placeholder="Type {{ Str::lower($sTitle) }} name" required="">
                     </div>
                     <div class="py-2 col-span-1">
                         <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                         <input type="text" name="email" id="email"
                             class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                             placeholder="Type {{ Str::lower($sTitle) }} email" required="">
                     </div>
                     <div class="py-2 col-span-1">
                         <label for="phone" class="block mb-2 text-sm font-medium text-gray-900">Phone</label>
                         <input type="text" name="phone" id="phone"
                             class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                             placeholder="Type {{ Str::lower($sTitle) }} phone" required="">
                     </div>
                     <div class="py-2 sm:col-span-3"><label for="description"
                             class="block mb-2 text-sm font-medium text-gray-900 ">Description</label>
                         <textarea id="description" rows="4"
                             class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500"
                             placeholder="Write description here"></textarea>
                     </div>
                     <div class=" sm:col-span-3 "><label for="description"
                             class="block mb-2 text-sm font-medium text-gray-900 ">Logo</label>
                         <input
                             class ="@error('avatar') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 @enderror"
                             type="file" name="logo" id="logo" accept="image/*" aria-describedby="logo_help"
                             accept="image/png, image/jpg, image/jpeg" />
                         <div class=" text-sm text-gray-500" id="logo_help">.png, .jpg, .jpeg (MAX. 2MB).</div>
                         @error('logo')
                             <p class=" text-sm text-red-600"><span class="font-medium">Oh, snapp!</span>
                                 {{ $message }}</p>
                         @enderror />
                     </div>
                 </div>
             </form>
             <div class="flex justify-center     space-x-2">
                 <button type="submit"
                     class=" text-black border border-green-600   inline-flex items-center bg-green-400 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                     <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewbox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                         <path fill-rule="evenodd"
                             d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                             clip-rule="evenodd" />
                     </svg>
                     Add {{ Str::lower($sTitle) }}
                 </button>
             </div>
         </div>
     </div>
 </div>

 @push('script')
     <script>
         const input = document.getElementById('logo');
         const previewPhoto = () => {
             const file = input.files[0];
             if (file) {
                 const reader = new FileReader();
                 reader.onload = function(event) {
                     preview.setAttribute('src', event.target.result);
                 }
                 reader.readAsDataURL(file);
             }
         }
         input.addEventListener('change', previewPhoto);
     </script>
     <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
     <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
     <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
     <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
     <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
     <script>
         FilePond.registerPlugin(FilePondPluginImagePreview);
         FilePond.registerPlugin(FilePondPluginFileValidateType);
         FilePond.registerPlugin(FilePondPluginFileValidateSize);

         const inputElement = document.querySelector('#logo');
         const pond = FilePond.create(inputElement, {
             acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg'],
             maxFileSize: '2MB',
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
