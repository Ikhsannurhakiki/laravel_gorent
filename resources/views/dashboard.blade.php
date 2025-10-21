<x-app-layout>
    <livewire:business-list />
    <!-- Add Business Card -->
    <button wire:click="$dispatch('openCreateBusiness')">
        <div
            class="p-6 min-h-55 bg-gray-50 border border-gray-200 rounded-lg shadow-sm flex flex-col items-center justify-center hover:shadow-md transition cursor-pointer">
            <div class="w-24 h-24 rounded-full bg-blue-900 flex items-center justify-center shadow-inner mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="w-20 h-20">
                    <path fill-rule="evenodd"
                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <p class="text-gray-600 text-md font-bold"> </p>
        </div>
    </button>
    <livewire:business />
</x-app-layout>
