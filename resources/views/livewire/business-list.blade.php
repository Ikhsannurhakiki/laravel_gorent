<div>
    <article class="w-screen h-screen flex items-center justify-center bg-white p-6">
        <!-- Businesses Section -->
        <section class="w-full max-w-6xl text-center">

            @if ($businesses->isEmpty())
                {{ $title = 'Create Business' }}
                <h2 class="text-2xl font-semibold text-gray-800 mb-8">
                    You have no businesses listed. Create one now.
                </h2>
            @else
                <h2 class="text-2xl font-semibold text-gray-800 mb-8">Your Branches</h2>
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 justify-center">
                    @foreach ($businesses as $business)
                        <a href="{{ route('business.show', [Auth::user()->username, $business->id]) }}">
                            <div
                                class="p-4 min-h-55 bg-gray-50 border border-gray-200 rounded-lg shadow-sm text-center hover:shadow-md transition cursor-pointer">
                                <img class="mx-auto mb-3 w-24 h-24 rounded-full shadow-lg object-cover"
                                    src="{{ $business->logo }}" alt="{{ $business->name }} logo">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $business->name }}</h3>
                                <p class="text-sm text-gray-500">{{ $business->address }}</p>
                            </div>
                        </a>
                    @endforeach


            @endif
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
</div>
</section>
</article>
</div>
