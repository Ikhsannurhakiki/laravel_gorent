<x-layout :title="$title">
    <main>
        <!-- resources/views/car-detail.blade.php -->
        <div class="w-full bg-white shadow-md overflow-hidden p-6">
            <!-- Image carousel -->
            <div class="grid md:grid-cols-2 gap-3">
                <img src='https://img.freepik.com/premium-photo/car-isolated-white-background-ford-focus-compact-car-white-car-blank-clean-whi-white-black_655090-717241.jpg'
                    alt="Ford Focus" class="rounded-xl w-full object-cover">
                <div class="relative">
                    <img src='https://img.freepik.com/premium-photo/car-isolated-white-background-ford-focus-compact-car-white-car-blank-clean-whi-white-black_655090-717240.jpg'
                        alt="Ford Focus" class="rounded-xl w-full object-cover">
                    <div
                        class="absolute inset-y-0 left-0 flex items-center justify-center w-10 bg-white/70 rounded-r-xl">
                        <button class="text-gray-600 hover:text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                    </div>
                    <div
                        class="absolute inset-y-0 right-0 flex items-center justify-center w-10 bg-white/70 rounded-l-xl">
                        <button class="text-gray-600 hover:text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Title and Price -->
            <div class="flex justify-between items-center mt-6">
                <div>
                    <h3 class="text-xs font-semibold text-gray-400 uppercase">Ford Focus</h3>
                    <h2 class="text-2xl font-bold text-gray-800 mt-1">1.5 EcoBlue ST-Line Style 115CV</h2>
                </div>
                <div class="text-right">
                    <button class="text-gray-400 hover:text-red-500 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-6 h-6">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5
                   2 5.42 4.42 3 7.5 3c1.74 0 3.41.81
                   4.5 2.09C13.09 3.81 14.76 3 16.5 3
                   19.58 3 22 5.42 22 8.5c0 3.78-3.4
                   6.86-8.55 11.54L12 21.35z" />
                        </svg>
                    </button>
                    <p class="text-xl font-bold text-gray-800">$28.00 <span class="text-sm font-medium text-gray-500">/
                            hour</span></p>
                </div>
            </div>

            <!-- Tabs -->
            <div class="flex gap-6 border-b border-gray-200 mt-6 text-sm font-medium text-gray-600">
                <button class="text-blue-600 border-b-2 border-blue-600 pb-2">Rent details</button>
                <button class="hover:text-blue-600 pb-2">Vehicle info</button>
                <button class="hover:text-blue-600 pb-2">Specifications</button>
                <button class="hover:text-blue-600 pb-2">Statistics</button>
                <button class="hover:text-blue-600 pb-2">Documents</button>
            </div>

            <!-- Map section -->
            <div class="mt-6 rounded-xl overflow-hidden border border-gray-200">
                <div class="h-64 w-full bg-gray-100 flex items-center justify-center text-gray-500">
                    <span>[Map Placeholder]</span>
                </div>
            </div>

            <!-- Booking Section -->
            <div class="mt-6 grid md:grid-cols-2 gap-6">
                <!-- Left form -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pick-up Date & Time</label>
                        <input type="datetime-local"
                            class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-500"
                            value="2023-07-29T14:00">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Drop-off Date & Time</label>
                        <input type="datetime-local"
                            class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-500"
                            value="2023-07-29T17:00">
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-700">Extra time?</span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer">
                            <div
                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full">
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Right price summary -->
                <div class="space-y-4 border-l pl-6">
                    <div>
                        <h4 class="text-gray-800 font-semibold mb-2">Insurance</h4>
                        <div class="space-y-2 text-sm">
                            <label class="flex items-center gap-2">
                                <input type="radio" name="insurance" class="text-blue-600" checked>
                                No insurance <span class="ml-auto text-gray-500">$0.00</span>
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="radio" name="insurance" class="text-blue-600">
                                Vehicle protection <span class="ml-auto text-gray-500">$52.00</span>
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="radio" name="insurance" class="text-blue-600">
                                3rd party liability <span class="ml-auto text-gray-500">$62.00</span>
                            </label>
                        </div>
                    </div>

                    <div class="text-sm flex justify-between text-gray-600">
                        <span>Sales taxes</span>
                        <span>$13.60</span>
                    </div>

                    <div class="flex justify-between items-center text-lg font-semibold text-gray-800 border-t pt-3">
                        <span>Total price</span>
                        <span>$149.60</span>
                    </div>

                    <div class="grid grid-cols-2 gap-2 mt-4">
                        <button
                            class="col-span-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl transition">Book
                            Vehicle</button>
                        <div class="col-span-2 text-center text-sm text-gray-500">
                            Free booking for <span class="font-medium text-gray-800">10 minutes</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
</x-layout>
