@if (Route::has('login'))
    <nav class="bg-white dark:bg-gray-800 shadow">
        <div class="mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">

                <!-- Logo / Branding -->
                <div class="flex-shrink-0">
                    <a href="{{ url('/') }}"
                        class="text-xl font-semibold text-gray-800 dark:text-gray-200 hover:text-blue-600 dark:hover:text-blue-400">
                        <span class="bg-red-400 text-white px-3 py-2 rounded-md">NJJHS</span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex md:items-center md:gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="px-4 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('registration.create') }}"
                            class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white shadow">
                            Registration
                        </a>

                        <a href="{{ route('registration.index') }}"
                            class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white shadow">
                            Registration List
                        </a>
                        <a href="{{ route('batch.index') }}"
                            class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white shadow">
                            Batch
                        </a>
                        <a href="{{ route('login') }}"
                            class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white shadow">
                            Log in
                        </a>

                        {{-- @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white shadow">
                                Register
                            </a>
                        @endif --}}
                    @endauth
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="md:hidden px-4 py-2 space-y-2 bg-gray-50 dark:bg-gray-900">
            @auth
                <a href="{{ url('/dashboard') }}"
                    class="block px-3 py-2 rounded-md text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">Dashboard</a>
            @else
                <a href="{{ route('registration.create') }}"
                    class="block px-3 py-2 rounded-md bg-blue-600 hover:bg-blue-700 text-white">Registration</a>
                <a href="{{ route('registration.index') }}"
                    class="block px-3 py-2 rounded-md bg-blue-600 hover:bg-blue-700 text-white">Registration List</a>
                <a href="{{ route('batch.index') }}"
                    class="block px-3 py-2 rounded-md bg-blue-600 hover:bg-blue-700 text-white">Batch</a>
                <a href="{{ route('login') }}"
                    class="block px-3 py-2 rounded-md bg-blue-600 hover:bg-blue-700 text-white">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="block px-3 py-2 rounded-md bg-blue-600 hover:bg-blue-700 text-white">Register</a>
                @endif
            @endauth
        </div>
    </nav>
@endif
