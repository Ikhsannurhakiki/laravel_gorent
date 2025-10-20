 <nav class="bg-gray-800 shadow">
     <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
         <div class="flex h-16 items-center justify-between">
             <div class="flex items-center">
                 <div class="shrink-0 border rounded-2xl bg-gray-200">
                     <img src="{{ asset('img/logo.png') }}" alt="Your Company" class="h-13   w-25   " />
                 </div>
                 <div class="hidden md:block">
                     <div class="ml-10 flex items-baseline space-x-4">
                         <x-my-nav-link href="/" :current="request()->is('/')">Home</x-my-nav-link>
                         @if (Auth::check() && Auth::user()->role === 'owner')
                             <x-my-nav-link href="/business/{{ Auth::user()->username }}"
                                 :current="request()->is('dashboard')">Dashboard</x-my-nav-link>
                         @endif
                         <x-my-nav-link href="/about" :current="request()->is('about')">About</x-my-nav-link>
                         <x-my-nav-link href="/contact" :current="request()->is('contact')">Contact</x-my-nav-link>
                     </div>
                 </div>
                 <div class="ml-2 w-full md:w-1/2">
                     <form class="flex items-center">
                         <label for="simple-search" class="sr-only">Search</label>
                         <div class="relative w-full">
                             <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                 <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                     fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                     <path fill-rule="evenodd"
                                         d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                         clip-rule="evenodd" />
                                 </svg>
                             </div>
                             <input type="text" id="simple-search"
                                 class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                 placeholder="Search" required="">
                         </div>
                     </form>
                 </div>
             </div>
             <div class="hidden md:block">
                 @if (Auth::check())
                     <div class="ml-4 flex items-center md:ml-6">
                         <button type="button"
                             class="relative rounded-full p-1 text-gray-400 hover:text-white focus:outline-2 focus:outline-offset-2 focus:outline-indigo-500">
                             <span class="absolute -inset-1.5"></span>
                             <span class="sr-only">View notifications</span>
                             <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                 data-slot="icon" aria-hidden="true" class="size-6">
                                 <path
                                     d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"
                                     stroke-linecap="round" stroke-linejoin="round" />
                             </svg>
                         </button>
                         <!-- Profile dropdown -->
                         <el-dropdown class="relative ml-3">
                             <button
                                 class="relative flex max-w-xs items-center rounded-full focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 cursor-pointer"">
                                 <span class="absolute -inset-1.5"></span>
                                 <span class="sr-only">Open user menu</span>
                                 {{-- <img src="{{ asset('storage/avatars/user1.jpg') }}" alt="Avatar"> --}}

                                 <img src="{{ Auth::user()->avatar ? asset(Auth::user()->avatar) : asset('img/default.jpg') }}"
                                     alt="{{ Auth::user()->name }}"
                                     class="size-8 rounded-full outline -outline-offset-1 outline-white/10" />
                                 <div class="text-gray-300 font-medium text-sm ml-3"> {{ Auth::user()->name }}</div>

                                 <div class="ms-1">
                                     <svg class="fill-current h-4 w-4 text-gray-300" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20">
                                         <path fill-rule="evenodd"
                                             d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                             clip-rule="evenodd" />
                                     </svg>
                                 </div>
                             </button>

                             <el-menu anchor="bottom end" popover
                                 class="w-48 origin-top-right rounded-md bg-gray-800 py-1 outline-1 -outline-offset-1 outline-white/10 transition transition-discrete [--anchor-gap:--spacing(2)] data-closed:scale-95 data-closed:transform data-closed:opacity-0 data-enter:duration-100 data-enter:ease-out data-leave:duration-75 data-leave:ease-in">
                                 <a href="/profile"
                                     class="block px-4 py-2 text-sm text-gray-300 focus:bg-white/5 focus:outline-hidden">Your
                                     profile</a>
                                 <a href="#"
                                     class="block px-4 py-2 text-sm text-gray-300 focus:bg-white/5 focus:outline-hidden">Settings</a>
                                 <form method="POST" action ="/logout">
                                     @csrf
                                     <button
                                         class="block w-full text-left px-4 py-2 text-sm text-gray-300 focus:bg-white/5 focus:outline-hidden cursor-pointer">Sign
                                         out</button>
                                 </form>
                             </el-menu>
                         </el-dropdown>
                     </div>
                 @else
                     <a href="/login"
                         class="mr-2 rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Log
                         in</a>
                     <span class="text-gray-300">or</span>
                     <a href="/register"
                         class="ml-2 rounded-md bg-white/10 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-white/20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Register</a>
                 @endif
             </div>
             <div class="-mr-2 flex md:hidden">
                 <!-- Mobile menu button -->
                 <button type="button" command="--toggle" commandfor="mobile-menu"
                     class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-white/5 hover:text-white focus:outline-2 focus:outline-offset-2 focus:outline-indigo-500">
                     <span class="absolute -inset-0.5"></span>
                     <span class="sr-only">Open main menu</span>
                     <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon"
                         aria-hidden="true" class="size-6 in-aria-expanded:hidden">
                         <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round"
                             stroke-linejoin="round" />
                     </svg>
                     <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon"
                         aria-hidden="true" class="size-6 not-in-aria-expanded:hidden">
                         <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                     </svg>
                 </button>
             </div>
         </div>
     </div>

     <el-disclosure id="mobile-menu" hidden class="block md:hidden">
         <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
             <x-my-nav-link class='block' href="/" :current="request()->is('/')">Home</x-my-nav-link>
             @if (Auth::check() && Auth::user()->role === 'owner')
                 <x-my-nav-link href="/dashboard" :current="request()->is('dashboard')">Dashboard</x-my-nav-link>
             @endif
             <x-my-nav-link class='block' href="/about" :current="request()->is('about')">About</x-my-nav-link>
             <x-my-nav-link class='block' href="/contact" :current="request()->is('contact')">Contact</x-my-nav-link>
         </div>
         @if (Auth::check())
             <div class="border-t border-white/10 pt-4 pb-3">
                 <div class="flex items-center px-5">
                     <div class="shrink-0">
                         <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                             alt="{{ Auth::user()->name }}"
                             class="size-10 rounded-full outline -outline-offset-1 outline-white/10" />
                     </div>
                     <div class="ml-3">
                         <div class="text-base/5 font-medium text-white">{{ Auth::user()->name }}</div>
                         <div class="text-sm font-medium text-gray-400">{{ Auth::user()->email }}</div>
                     </div>
                     <button type="button"
                         class="relative ml-auto shrink-0 rounded-full p-1 text-gray-400 hover:text-white focus:outline-2 focus:outline-offset-2 focus:outline-indigo-500">
                         <span class="absolute -inset-1.5"></span>
                         <span class="sr-only">View notifications</span>
                         <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                             data-slot="icon" aria-hidden="true" class="size-6">
                             <path
                                 d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"
                                 stroke-linecap="round" stroke-linejoin="round" />
                         </svg>
                     </button>
                 </div>
                 <div class="mt-3 space-y-1 px-2">
                     <a href="/profile"
                         class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-white/5 hover:text-white">Your
                         profile</a>
                     <a href="/dashboard"
                         class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-white/5 hover:text-white">Settings</a>
                     <form method="POST" action ="/logout">
                         @csrf
                         <button
                             class="block w-full text-left rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-white/5 hover:text-white cursor-pointer">Sign
                             out</button>
                     </form>
                 </div>
             </div>
         @else
             <div class="border-t border-white/10 pt-4 pb-3">
                 <div class="mt-3 space-y-1 px-2">
                     <a href="/login"
                         class="block rounded-md bg-indigo-600 px-3.5 py-2.5 text-base font-medium text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Log
                         in</a>
                     <a href="/register"
                         class="block rounded-md bg-white/10 px-3.5 py-2.5 text-base font-medium text-white shadow-sm hover:bg-white/20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Register</a>
                 </div>
             </div>
         @endif
     </el-disclosure>
 </nav>
