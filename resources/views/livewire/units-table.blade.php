<div>
    <div class="bg-white p-6 rounded-xl shadow-md">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Units Table</h2>
            <div class="flex justify-end items-center space-x-4">
                <input type="text" wire:model.debounce.500ms="search" placeholder="Search units..."
                    class="border rounded-lg px-3 py-2 w-72" />
                <button id="addUnitButton" data-modal-target="addUnit" data-modal-toggle="addUnit"
                    class="w-full md:w-auto flex items-center text-white justify-center py-2.5 px-4 text-sm font-medium focus:outline-none bg-blue-700 rounded-lg border border-gray-200 hover:bg-blue-500 hover:text-primary-700 hover:font-extrabold focus:z-10 focus:ring-4 focus:ring-gray-200"
                    type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        class="h-4 w-4 mr-2 text-white" stroke-width="5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Units
                </button>
            </div>
        </div>

        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="py-2 px-3">#</th>
                    <th class="py-2 px-3">Name</th>
                    <th class="py-2 px-3">Business</th>
                    <th class="py-2 px-3">Type</th>
                    <th class="py-2 px-3">Price/Day</th>
                    <th class="py-2 px-3">Rating</th>
                    <th class="py-2 px-3">Reviews</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($units as $unit)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2 px-3">{{ $loop->iteration }}</td>
                        <td class="py-2 px-3">{{ $unit->name }}</td>
                        <td class="py-2 px-3">{{ $unit->business->name }}</td>
                        <td class="py-2 px-3 capitalize">{{ $unit->type }}</td>
                        <td class="py-2 px-3">Rp{{ number_format($unit->price_per_day, 0, ',', '.') }}</td>
                        <td class="py-2 px-3 text-yellow-500">⭐ {{ $unit->average_rating }}</td>
                        <td class="py-2 px-3">{{ $unit->review_count }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-gray-500">No units found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            <div class="pagination-wrapper">
                {{ $units->links() }}
            </div>
        </div>
    </div>

</div>
