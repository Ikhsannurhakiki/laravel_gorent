<x-app-layout>

    @push('style')
        <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
        <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
            rel="stylesheet" />
    @endpush

    <!-- Sidebar + Tabs -->
    <div class="min-h-screen flex items-stretch justify-center bg-white p-4">
        <div class="flex w-full max-w gap-6">
            <!-- Sidebar -->
            <ul class="flex flex-col w-60 space-y-3 text-sm font-medium text-gray-600">
                <li><button data-tabs-target="profile"
                        class="tab-btn flex items-center w-full px-4 py-3 bg-green-500  hover:bg-green-700 text-black hover:text-white rounded-lg cursor-pointer">Profile</button>
                </li>
                <li><button data-tabs-target="dashboard"
                        class="tab-btn flex items-center w-full px-4 py-3 bg-green-500  hover:bg-green-700 text-black hover:text-white rounded-lg cursor-pointer">Dashboard</button>
                </li>
                <li><button data-tabs-target="units"
                        class="tab-btn flex items-center w-full px-4 py-3 bg-green-500  hover:bg-green-700 text-black hover:text-white rounded-lg cursor-pointer">Units</button>
                </li>
            </ul>

            <!-- Main Content -->
            <div class="flex-1 bg-gray-50 rounded-lg p-4">
                <!-- PROFILE TAB -->
                <div id="profile" class="tab-content">
                    <!-- ✅ Bagian ini hanya Livewire profile tanpa tombol -->
                    <livewire:business-profile :businessId="$business->id" />
                </div>

                <!-- DASHBOARD TAB -->
                <div id="dashboard" class="tab-content hidden">
                    <h3 class="text-lg font-bold mb-2 px-5">Dashboard</h3>
                </div>

                <!-- UNITS TAB -->
                <div id="units" class="tab-content hidden">
                    <livewire:units-table :business="$business" />
                </div>
            </div>
        </div>


        <!-- ✅ Modal tetap di luar semua Livewire -->
        <livewire:business />
        <livewire:unit-form />
    </div>


    @push('script')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const tabButtons = document.querySelectorAll(".tab-btn");
                const tabContents = document.querySelectorAll(".tab-content");

                if (!tabButtons.length) return;

                function activateTab(targetId) {
                    tabButtons.forEach(btn => {
                        btn.classList.remove("bg-blue-700", "text-white");
                        btn.classList.add("bg-gray-50", "text-gray-600");
                    });

                    tabContents.forEach(content => content.classList.add("hidden"));

                    const activeBtn = document.querySelector(`[data-tabs-target="${targetId}"]`);
                    const activeContent = document.getElementById(targetId);

                    if (activeBtn && activeContent) {
                        activeBtn.classList.add("bg-blue-700", "text-white");
                        activeBtn.classList.remove("bg-gray-50", "text-gray-600");
                        activeContent.classList.remove("hidden");
                    }
                }

                tabButtons.forEach(btn => {
                    btn.addEventListener("click", function() {
                        const targetId = btn.getAttribute("data-tabs-target");
                        if (targetId) {
                            activateTab(targetId);
                            history.replaceState(null, null, "#" + targetId);
                        }
                    });
                });

                const hash = window.location.hash.replace("#", "");
                if (hash) activateTab(hash);
                else activateTab(tabButtons[0].getAttribute("data-tabs-target"));

                document.addEventListener("click", function(e) {
                    const link = e.target.closest(".pagination-wrapper a");
                    if (link) {
                        const currentHash = window.location.hash;
                        if (currentHash) link.href += currentHash;
                    }
                });
            });
        </script>
    @endpush

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

</x-app-layout>
