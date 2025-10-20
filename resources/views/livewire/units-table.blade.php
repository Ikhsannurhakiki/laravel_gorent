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
                <x-form-add-unit />
            </div>
        </div>

        <table class="w-full text-center border-collapse">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="py-5 px-3">#</th>
                    <th class="py-5 px-3">Name</th>
                    <th class="py-5 px-2">Type</th>
                    <th class="py-5 px-3">Price/Day</th>
                    <th class="py-5 px-2">Rating</th>
                    <th class="py-5 px-2">Reviews</th>
                    <th class="py-5 px-3">Status</th>
                    <th class="py-5 px-2">Action</th>

                </tr>
            </thead>
            <tbody>
                @forelse ($units as $unit)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-4 px-3">{{ $loop->iteration }}</td>
                        <td class="py-4 px-3 text-start">{{ $unit->name }}</td>
                        <td class="py-4 px-3 capitalize">{{ $unit->type }}</td>
                        <td class="py-4 px-3">Rp{{ number_format($unit->price_per_day, 0, ',', '.') }}</td>
                        <td class="py-4 px-3 text-yellow-500">⭐ {{ $unit->average_rating }}</td>
                        <td class="py-4 px-3">{{ $unit->review_count }}</td>
                        <td class="py-4 px-3">
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
                        </td>
                        <td class="px-4 py-3 flex items-center justify-center">
                            <button id="dropdown-button-{{ $unit->id }}"
                                data-dropdown-toggle="dropdown-{{ $unit->id }}"
                                class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none"
                                type="button">
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                </svg>
                            </button>

                            <div id="dropdown-{{ $unit->id }}"
                                class="hidden z-10 w-44 bg-white rounded-lg divide-y divide-gray-100 shadow">
                                <ul class=" text-sm text-gray-700"
                                    aria-labelledby="dropdown-button-{{ $unit->id }}">
                                    <li class= "hover:bg-green-300 rounded-t-lg"><a href="#"
                                            class="block py-3 px-4 ">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor"
                                                class="w-4 h-4 inline-block mr-1">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                                            </svg>
                                            Show</a>
                                    </li>
                                    <li class="hover:bg-yellow-300"><a href="#" class="block py-3 px-4 ">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor"
                                                class="w-4 h-4 inline-block mr-1">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.93z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 7.125l-6.75-6.75" />
                                            </svg>
                                            Edit</a>
                                    </li>
                                    <li class="hover:bg-red-400 rounded-b-lg">
                                        <a href="#" class="block py-3 px-4 text-sm text-gray-700 ">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor"
                                                class="w-4 h-4 inline-block mr-1 ">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                            Delete</a>
                                    </li>
                                </ul>

                            </div>
                        </td>
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
