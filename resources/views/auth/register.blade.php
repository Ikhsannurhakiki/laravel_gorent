<x-guest-layout>
    <div class="grid gap-8 mb-6 lg:mb-16 md:grid-cols-2">
        <div class="relative text-5xl font-bold text-gray-800" id="word-container">
            <span class="word show tracking-in text-blue-600">Pakai Sekali</span>
            <span class="word text-green-600">Buat Apa Beli?</span>
            <span class="word text-green-600">GoRent aja</span>
        </div>

        <script>
            const words = document.querySelectorAll('#word-container .word');
            let current = 0;
            const duration = 4000; // total time before switching (ms)
            const animDuration = 500; // in/out animation time (ms)

            function cycleWords() {
                const currentWord = words[current];
                const nextWord = words[(current + 1) % words.length];

                // animate current word out
                currentWord.classList.remove('tracking-in');
                currentWord.classList.add('tracking-out');

                setTimeout(() => {
                    // hide current word
                    currentWord.classList.remove('show', 'tracking-out');

                    // show next word
                    nextWord.classList.add('show', 'tracking-in');

                    // update index
                    current = (current + 1) % words.length;
                }, animDuration);
            }

            // loop forever
            setInterval(cycleWords, duration);
        </script>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div class="mt-4">
                <div>
                    <x-input-label for="username" :value="__('Username')" />
                    <x-text-input id="username" class="block mt-1 w-full" type="text" name="username"
                        :value="old('username')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('username')" class="mt-2" />
                </div>
            </div>



            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-hidden focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ms-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
