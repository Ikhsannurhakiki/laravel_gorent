<x-app-layout :title="$title">
    <section class="bg-white py-8">
        <div class="py-2 px-2 justify-center mx-auto max-w-screen-xl lg:px-6 ">
            <div class="grid gap-4   lg:mb-16 grid-cols-2 lg:grid-cols-5 md:grid-cols-3">
                @foreach ($units as $unit)
                    <a href="/unit/{{ $unit->id }}">
                        <div class=" rounded-2xl bg-white">
                            <x-car-card :unit="$unit" />
                        </div>
                    </a>
                @endforeach

            </div>
        </div>
    </section>
</x-app-layout>
