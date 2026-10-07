<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saglabātie</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-900 antialiased">
    <nav class="bg-gray-900 text-white">
        <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
            <span class="text-lg font-bold">GearUp</span>
            <div class="flex items-center gap-4">
                @guest
                    <a href="{{ route('login') }}" class="text-sm hover:underline">Pieteikties</a>
                    <a href="{{ route('register') }}" class="text-sm hover:underline">Reģistrēties</a>
                @endguest
                @auth
                    <span class="text-sm">{{ Auth::user()->name }}</span>
                    <a href="{{ route('my-listings') }}" class="text-sm hover:underline">Mani sludinājumi</a>
                    <a href="{{ route('saved') }}" class="text-sm hover:underline">Saglabātie</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm hover:underline">Iziet</button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>
    <div class="max-w-6xl mx-auto px-4 py-10">
        <a href="{{ route('listings.index') }}" class="text-sm text-gray-600 hover:underline">&larr; Atpakaļ uz sludinājumiem</a>

        <h1 class="text-3xl font-bold mt-4 mb-8">Saglabātie sludinājumi</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($listings as $listing)
                @php($thumb = $listing->images->first())
                <div class="border border-gray-200 rounded-lg p-5 flex flex-col">
                    @if ($thumb)
                        <img src="{{ Storage::url($thumb->image_path) }}" alt="{{ $listing->make }} {{ $listing->model }}" class="mb-4 w-full h-40 object-cover rounded">
                    @else
                        <div class="mb-4 w-full h-40 rounded bg-gray-200 flex items-center justify-center text-sm text-gray-500">
                            Nav bildes
                        </div>
                    @endif

                    <h2 class="text-xl font-semibold">{{ $listing->make }} {{ $listing->model }}</h2>
                    <p class="mt-2 text-gray-700">
                        {{ $listing->vehicle_type === 'motocikls' ? 'Motocikls' : 'Auto' }}
                        @if ($listing->engine_volume)
                            · {{ $listing->engine_volume }} l
                        @endif
                    </p>
                    <p class="text-gray-700">Gads: {{ $listing->year }}</p>
                    <p class="text-gray-700">Cena: €{{ $listing->price }}</p>
                    <p class="text-gray-700">Degviela: {{ $listing->fuel_type }}</p>
                    <p class="text-gray-700">Nobraukums: {{ $listing->mileage }} km</p>

                    <a href="{{ route('listings.show', $listing) }}" class="mt-auto mt-4 block text-center bg-gray-900 text-white px-4 py-2 rounded hover:bg-gray-700">
                        Skatīt
                    </a>
                </div>
            @empty
                <p class="col-span-full text-gray-500">Nav saglabātu sludinājumu</p>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $listings->links() }}
        </div>
    </div>
</body>
</html>
