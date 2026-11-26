    <nav class="bg-gray-900 text-white sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
            <span class="text-lg font-bold">GearUp</span>
            <div class="flex items-center gap-4">
                @guest
                    <a href="{{ route('login') }}" class="text-sm hover:underline">Pieteikties</a>
                    <a href="{{ route('register') }}" class="text-sm hover:underline">Reģistrēties</a>
                @endguest
                @auth
                    <a href="{{ route('profile.show', Auth::user()) }}" class="text-sm hover:underline">{{ Auth::user()->name }}</a>
                    <a href="{{ route('my-listings') }}" class="text-sm hover:underline">Mani sludinājumi</a>
                    <a href="{{ route('saved') }}" class="text-sm hover:underline">Saglabātie</a>
                    <a href="{{ route('settings.edit') }}" class="text-sm hover:underline">Settings</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm hover:underline">Iziet</button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>
