<!-- resources/views/components/filter-sidebar.blade.php -->
<div x-data="{ open: true }" class="w-full md:w-80 bg-white border border-gray-200 p-6 shadow-sm">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold text-gray-800">Filter by:</h2>
        <button class="text-sm text-blue-600 hover:underline">Reset all</button>
    </div>

    <!-- Search -->
    <div class="mb-4">
        <input type="text" placeholder="Search"
            class="w-full p-2 border rounded-lg text-sm focus:ring-2 focus:ring-blue-500" />
    </div>

    <!-- Rental Type -->
    <div class="border-t border-gray-200 pt-4">
        <button @click="open = !open" class="flex justify-between items-center w-full text-gray-800 font-medium">
            <span>Rental Type</span>
            <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        <div x-show="open" class="mt-3 flex gap-2">
            <button class="px-3 py-1 text-sm border rounded-lg hover:bg-blue-50">Any</button>
            <button class="px-3 py-1 text-sm border rounded-lg hover:bg-blue-50">Per day</button>
            <button class="px-3 py-1 text-sm border-blue-600 bg-blue-50 text-blue-600 rounded-lg">Per hour</button>
        </div>
    </div>

    <!-- Available -->
    <div class="flex justify-between items-center border-t border-gray-200 pt-4">
        <span class="text-gray-800 font-medium">Available now only</span>
        <label class="relative inline-flex items-center cursor-pointer">
            <input type="checkbox" class="sr-only peer" />
            <div
                class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full">
            </div>
        </label>
    </div>

    <!-- Price Range -->
    <div class="border-t border-gray-200 pt-4">
        <h3 class="text-gray-800 font-medium mb-2">Price Range / Hour</h3>
        <div class="mb-2">
            <div class="h-2 bg-gray-100 rounded-full relative">
                <div class="absolute h-2 bg-blue-500 rounded-full w-1/2 left-1/4"></div>
            </div>
        </div>
        <div class="flex justify-between text-sm text-gray-700">
            <span>From <strong>$22.00</strong></span>
            <span>To <strong>$98.50</strong></span>
        </div>
    </div>

    <!-- Car Brand -->
    <div class="border-t border-gray-200 pt-4">
        <h3 class="text-gray-800 font-medium mb-2">Car Brand</h3>
        <div class="flex flex-wrap gap-2">
            <span class="px-3 py-1 text-sm bg-blue-50 text-blue-600 rounded-lg">Toyota</span>
            <span class="px-3 py-1 text-sm bg-blue-50 text-blue-600 rounded-lg">Honda</span>
        </div>
    </div>

    <!-- Car Model & Year -->
    <div class="border-t border-gray-200 pt-4">
        <h3 class="text-gray-800 font-medium mb-2">Car Model & Year</h3>
        <div class="flex flex-wrap gap-2">
            <span class="px-3 py-1 text-sm border rounded-lg hover:bg-blue-50">2021</span>
            <span class="px-3 py-1 text-sm border rounded-lg hover:bg-blue-50">2022</span>
            <span class="px-3 py-1 text-sm border rounded-lg hover:bg-blue-50">2023</span>
        </div>
    </div>

    <!-- Body Style -->
    <div class="border-t border-gray-200 pt-4">
        <h3 class="text-gray-800 font-medium mb-3">Body Style</h3>
        <div class="grid grid-cols-2 gap-2 text-sm text-gray-700">
            <label><input type="checkbox" class="mr-2">Sedan</label>
            <label><input type="checkbox" class="mr-2">Wagon</label>
            <label><input type="checkbox" class="mr-2">Coupe</label>
            <label><input type="checkbox" class="mr-2" checked>Hatchback</label>
            <label><input type="checkbox" class="mr-2" checked>Crossover</label>
            <label><input type="checkbox" class="mr-2">Pickup</label>
        </div>
    </div>

    <!-- Transmission -->
    <div class="border-t border-gray-200 pt-4">
        <h3 class="text-gray-800 font-medium mb-3">Transmission</h3>
        <div class="flex flex-col text-sm text-gray-700 gap-1">
            <label><input type="radio" name="trans" class="mr-2" checked>Any (2,108)</label>
            <label><input type="radio" name="trans" class="mr-2">Automatic (1,142)</label>
            <label><input type="radio" name="trans" class="mr-2">Manual (966)</label>
        </div>
    </div>

    <!-- Fuel Type -->
    <div class="border-t border-gray-200 pt-4">
        <h3 class="text-gray-800 font-medium mb-3">Fuel Type</h3>
        <div class="flex flex-col text-sm text-gray-700 gap-1">
            <label><input type="checkbox" class="mr-2">Diesel</label>
            <label><input type="checkbox" class="mr-2">Electric</label>
            <label><input type="checkbox" class="mr-2">Hybrid</label>
            <label><input type="checkbox" class="mr-2">Petrol</label>
        </div>
    </div>
</div>
