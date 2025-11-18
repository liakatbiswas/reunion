@if (Route::has('login'))
    <nav class="max-w-6xl mx-auto flex items-center justify-between px-4">

        <!-- Logo / Branding -->
        <div class="text-xl font-semibold text-gray-800 dark:text-gray-200">
            <a href="{{ url('/') }}" class="hover:text-blue-600 dark:hover:text-blue-400">
                NJJHS
            </a>
        </div>

        <!-- Navigation Links -->
        <div class="flex items-center gap-4">
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

                <a href="{{ route('login') }}" class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white shadow">
                    Log in
                </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white shadow">
                        Register
                    </a>
                @endif
            @endauth

        </div>
    </nav>
@endif
