<x-app-layout>
    <div class="min-h-screen flex items-stretch justify-center bg-white p-4">
        <div class="flex w-full max-w gap-6">

            <!-- Sidebar -->
            <ul class="flex flex-col w-60 space-y-3 text-sm font-medium text-gray-600">
                <li>
                    <button data-tab="profile"
                        class="tab-btn flex items-center w-full px-4 py-3 bg-blue-700 text-white rounded-lg">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z" />
                        </svg>
                        Profile
                    </button>
                </li>

                <li>
                    <button data-tab="dashboard"
                        class="tab-btn flex items-center w-full px-4 py-3 rounded-lg bg-gray-50 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                        </svg>
                        Dashboard
                    </button>
                </li>

                <li>
                    <button data-tab="units"
                        class="tab-btn flex items-center w-full px-4 py-3 rounded-lg bg-gray-50  transition-colors">
                        <svg class=" w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2" />
                            <circle cx="7" cy="17" r="2" />
                            <path d="M9 17h6" />
                            <circle cx="17" cy="17" r="2" />
                        </svg>
                        Units
                    </button>
                </li>
            </ul>


            <!-- Main content -->
            <div class="flex-1 h-full    bg-gray-50 rounded-lg text-gray-700 p-4">
                <div id="profile" class="tab-content">
                    {{-- <h3 class="text-lg font-bold mb-2 px-5">Profile</h3> --}}
                    <x-admin-business-profile :business="$business" />
                </div>

                <div id="dashboard" class="tab-content hidden">
                    <h3 class="text-lg font-bold mb-2 px-5">Dashboard </h3>
                </div>

                <div id="settings" class="tab-content hidden">
                    <h3 class="text-lg font-bold mb-2">Settings Tab</h3>
                    <p>Settings content here...</p>
                </div>
                <div id="units" class="tab-content hidden">
                    <h3 class="text-lg font-bold mb-2 px-5">List Of Units</h3>
                    <x-table :units="$units" />
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const tabButtons = document.querySelectorAll('.tab-btn');
                const tabContents = document.querySelectorAll('.tab-content');

                tabButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        const target = button.getAttribute('data-tab');

                        // Reset styles
                        tabButtons.forEach(btn => {
                            btn.classList.remove('bg-blue-700', 'text-white');
                            btn.classList.add('bg-gray-50', 'text-gray-600');
                        });

                        // Hide all tab contents
                        tabContents.forEach(content => content.classList.add('hidden'));

                        // Activate the clicked tab
                        button.classList.add('bg-blue-700', 'text-white');
                        button.classList.remove('bg-gray-50', 'text-gray-600');
                        document.getElementById(target).classList.remove('hidden');
                    });
                });
            });
        </script>
    @endpush

</x-app-layout>
