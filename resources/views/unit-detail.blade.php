<x-layout :title="$title">
    <main class="py-6">
        <div class="w-full bg-white rounded-2xl shadow-md overflow-hidden p-6">
            <!-- IMAGE CAROUSEL -->
            <div x-data="{
                activeIndex: 0,
                images: {{ json_encode($unit->getMedia('gallery')->map->getUrl()) }},
                bg: 'white'
            }" :class="bg === 'white' ? 'bg-white' : 'bg-black'"
                class="relative w-full overflow-hidden rounded-2xl border border-gray-100 transition-colors">
                <!-- Background toggle -->
                <div class="absolute top-3 right-3 z-30 flex items-center gap-2">
                    <button @click="bg = 'white'" :class="bg === 'white' ? 'ring-2 ring-blue-500' : ''"
                        class="w-7 h-7 rounded-full bg-white border border-gray-300 shadow-sm"
                        aria-label="White background"></button>
                    <button @click="bg = 'black'" :class="bg === 'black' ? 'ring-2 ring-blue-500' : ''"
                        class="w-7 h-7 rounded-full bg-black border border-gray-700 shadow-sm"
                        aria-label="Black background"></button>
                </div>

                <!-- Main Image -->
                <div class="relative h-[460px] flex items-center justify-center overflow-hidden">
                    <template x-if="images.length > 0">
                        <img :src="images[activeIndex]" alt="Gallery image"
                            class="w-full h-full object-contain transition-all duration-500">
                    </template>

                    <!-- Prev button -->
                    <button @click="activeIndex = activeIndex === 0 ? images.length - 1 : activeIndex - 1"
                        class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/70 hover:bg-white text-gray-800 rounded-full p-2 shadow-lg backdrop-blur-sm transition"
                        aria-label="Previous image">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>

                    <!-- Next button -->
                    <button @click="activeIndex = (activeIndex + 1) % images.length"
                        class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/70 hover:bg-white text-gray-800 rounded-full p-2 shadow-lg backdrop-blur-sm transition"
                        aria-label="Next image">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    <!-- Dots -->
                    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex space-x-2">
                        <template x-for="(img, i) in images" :key="i">
                            <div @click="activeIndex = i" class="w-2.5 h-2.5 rounded-full cursor-pointer transition"
                                :class="activeIndex === i ? 'bg-blue-600 scale-110' : 'bg-gray-400 hover:bg-gray-500'">
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <!-- TITLE + PRICE -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mt-6">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">{{ $unit->name }}</h2>
                    <div class="mt-2 flex flex-wrap gap-2">
                        @foreach ($unit->tags as $tag)
                            <span class="text-xs px-2 py-1 bg-blue-50 text-blue-700 rounded-full font-medium">
                                #{{ $tag->name }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <div class="mt-4 md:mt-0 text-right">
                    <button id="favBtn"
                        class="text-gray-400 hover:text-red-500 p-2 rounded-full transition focus:outline-none"
                        aria-pressed="false" title="Add to favorites">
                        <svg id="favIcon" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"
                            class="w-7 h-7">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28
                            2 8.5 2 5.42 4.42 3 7.5 3
                            c1.74 0 3.41.81 4.5 2.09
                            C13.09 3.81 14.76 3 16.5 3
                            19.58 3 22 5.42 22 8.5
                            c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                        </svg>
                    </button>

                    <p class="text-2xl font-bold text-gray-900 mt-1">
                        IDR {{ number_format($unit->price_per_day, 0, ',', '.') }}
                        <span class="text-sm text-gray-500 font-medium">/ day</span>
                    </p>
                </div>
            </div>

            <!-- TABS -->
            <div class="flex gap-6 border-b border-gray-200 mt-8 text-sm font-medium text-gray-600" role="tablist">
                @foreach (['rent' => 'Rent details', 'info' => 'Vehicle info', 'specs' => 'Specifications', 'stats' => 'Statistics', 'docs' => 'Documents'] as $key => $label)
                    <button data-tab-button="{{ $key }}"
                        class="tab-btn pb-3 border-b-2 border-transparent hover:border-blue-500 hover:text-blue-600 transition"
                        :class="{
                            'text-blue-600 border-blue-600': '{{ $key }}'
                            === 'rent'
                        }">
                        {{ $label }}
                    </button>
                @endforeach
            </div>

            <!-- TAB CONTENTS -->
            <div id="tabContents" class="mt-6 space-y-4 text-sm text-gray-700">
                <section data-tab-content="rent" class="tab-content">
                    <p>Availability, pricing breakdown, and booking form are shown below.</p>
                </section>
                <section data-tab-content="info" class="tab-content hidden">
                    <ul class="list-disc ml-5">
                        <li>Make: Ford</li>
                        <li>Model: Focus</li>
                        <li>Year: 2021</li>
                        <li>Seats: 5</li>
                    </ul>
                </section>
                <section data-tab-content="specs" class="tab-content hidden">
                    <table class="w-full text-left text-sm">
                        <tr>
                            <td class="py-1 text-gray-600">Engine</td>
                            <td>1.5L EcoBlue</td>
                        </tr>
                        <tr>
                            <td class="py-1 text-gray-600">Power</td>
                            <td>115 CV</td>
                        </tr>
                        <tr>
                            <td class="py-1 text-gray-600">Fuel</td>
                            <td>Diesel</td>
                        </tr>
                    </table>
                </section>
                <section data-tab-content="stats" class="tab-content hidden">
                    <p>Usage stats and ratings.</p>
                </section>
                <section data-tab-content="docs" class="tab-content hidden">
                    <p>Upload and view documents here.</p>
                </section>
            </div>

            <!-- MAP PLACEHOLDER -->
            <div class="mt-8 rounded-xl overflow-hidden border border-gray-200">
                <div class="h-64 w-full bg-gray-100 flex items-center justify-center text-gray-500">
                    <span>[Map Placeholder]</span>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tabButtons = document.querySelectorAll('[data-tab-button]');
            const tabContents = document.querySelectorAll('[data-tab-content]');

            function showTab(key) {
                tabButtons.forEach(btn => {
                    const active = btn.getAttribute('data-tab-button') === key;
                    btn.classList.toggle('text-blue-600', active);
                    btn.classList.toggle('border-blue-600', active);
                });
                tabContents.forEach(sec => {
                    sec.classList.toggle('hidden', sec.getAttribute('data-tab-content') !== key);
                });
            }
            tabButtons.forEach(btn => btn.addEventListener('click', () => showTab(btn.getAttribute(
                'data-tab-button'))));
            showTab('rent');

            const favBtn = document.getElementById('favBtn');
            favBtn?.addEventListener('click', () => {
                const pressed = favBtn.getAttribute('aria-pressed') === 'true';
                favBtn.setAttribute('aria-pressed', String(!pressed));
                favBtn.classList.toggle('text-red-500', !pressed);
            });
        });
    </script>
</x-layout>
