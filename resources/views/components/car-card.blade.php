<!-- Car Card Component -->
<div class="block bg-white shadow-md overflow-hidden hover:shadow-lg transition relative w-full max-w-sm rounded-lg">

    <!-- Image -->
    <div class="w-full h-40 bg-black flex items-center justify-center overflow-hidden">
        <img src="{{ $unit->thumbnail }}" alt="{{ $unit->name }}" class="w-full h-full object-cover">
    </div>



    <!-- Content -->
    <div class="p-3">
        <h3 class="text-md uppercase text-black font-semibold">{{ $unit->name }}</h3>

        <!-- Price -->
        <div class="flex justify-between items-center">
            <span class="text-gray-800 font-bold text-md">
                Rp. {{ number_format($unit->price_per_day, 0, ',', '.') }}
                <span class="text-lg font-normal text-gray-500">/hari</span>
            </span>
        </div>

        <h2 class="text-sm text-gray-800">{{ $unit->business->name }}</h2>

        <!-- Rating, Availability & Favorite -->
        <div class="flex items-center justify-between py-2">
            <!-- Availability -->
            @if ($unit->is_available)
                <span
                    class="py-0.5 inline-flex items-center text-xs font-medium text-green-700 bg-green-50 border border-green-200 px-2.5 rounded-full shadow-sm">
                    Available
                </span>
            @else
                <span
                    class="py-0.5 inline-flex items-center text-xs font-medium text-red-700 bg-red-50 border border-red-200 px-2.5 rounded-full shadow-sm">
                    Not available
                </span>
            @endif

            <!-- Rating -->
            <div
                class="inline-flex items-center gap-1.5 text-xs text-gray-800 bg-yellow-50 border border-yellow-200 px-2.5 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"
                    class="w-3 h-3 text-yellow-500">
                    <path
                        d="M12 .587l3.668 7.431L24 9.748l-6 5.848 1.417 8.268L12 19.771l-7.417 4.093L6 15.596 0 9.748l8.332-1.73z" />
                </svg>
                <span class="font-bold text-sm">{{ $unit->averageRating }}</span>
                <span class="text-gray-400 text-xs">({{ $unit->reviewCount }})</span>
            </div>


            <!-- Favorite Icon -->
            <button class="text-gray-400 hover:text-red-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-6 h-6">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5
         2 5.42 4.42 3 7.5 3c1.74 0 3.41.81
         4.5 2.09C13.09 3.81 14.76 3 16.5 3
         19.58 3 22 5.42 22 8.5c0 3.78-3.4
         6.86-8.55 11.54L12 21.35z" />
                </svg>
            </button>
        </div>

        <hr class="my-1 border-gray-300">

        <!-- Features -->
        <div class="text-xs font-light text-gray-600 grid grid-cols-2 gap-y-1">
            <div class="flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    class="w-5 h-5 text-blue-500">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 13l4-4h13a2 2 0 012 2v7H3v-5z" />
                </svg>
                Hatchback
            </div>
            <div class="flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    class="w-5 h-5 text-blue-500">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 13V6h12v7M6 17h12v1a2 2 0 01-2 2H8a2 2 0 01-2-2v-1z" />
                </svg>
                Manual
            </div>
            <div class="flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    class="w-5 h-5 text-blue-500">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 17v2h6v-2M12 3v14m-9 4h18" />
                </svg>
                Diesel
            </div>
            <div class="flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    class="w-5 h-5 text-blue-500">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 11c0-1.657-1.343-3-3-3S6 9.343 6 11v4H3v4h18v-4h-3v-4c0-1.657-1.343-3-3-3s-3 1.343-3 3z" />
                </svg>
                5 Seats
            </div>
        </div>
    </div>
</div>
