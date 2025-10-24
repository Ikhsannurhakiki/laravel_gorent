<div wire:key="business-profile-{{ $business->id }}">
    <section class="bg-white flex-1 h-full px-1">
        <div class="grid max-w-screen-xl px-4 py-4 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="mr-auto place-self-center lg:col-span-7 lg:px-20">
                <h1 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none sm:text-md md:text-2xl">
                    {{ $business->name }}
                </h1>
                <p class="max-w-2xl font-bold text-gray-500 md:text-md lg:text-xl">
                    {{ $business->address }}
                </p>
                <p class="max-w-2xl mb-6 font-bold text-gray-500 lg:mb-8 md:text-xs lg:text-sm">
                    {{ $business->phone }} - {{ $business->email }}
                </p>
            </div>
            <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
                <img src="{{ asset('storage/' . $business->logo) }}" alt="{{ $business->name }}">
            </div>
        </div>
    </section>
</div>
