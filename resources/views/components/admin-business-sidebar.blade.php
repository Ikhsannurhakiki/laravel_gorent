@props(['business'])

<div>
    <ul class="flex flex-col w-60 space-y-3 text-sm font-medium text-gray-600">
        <li>
            <button @click="$dispatch('change-tab', 'profile')"
                class="px-4 py-3 rounded-lg bg-gray-50 hover:bg-blue-700 hover:text-white">
                Profile
            </button>
        </li>
        <li>
            <button @click="$dispatch('change-tab', 'dashboard')"
                class="px-4 py-3 rounded-lg bg-gray-50 hover:bg-blue-700 hover:text-white">
                Dashboard
            </button>
        </li>
        <li>
            <button @click="$dispatch('change-tab', 'units')"
                class="px-4 py-3 rounded-lg bg-gray-50 hover:bg-blue-700 hover:text-white">
                Units
            </button>
        </li>
    </ul>
</div>
