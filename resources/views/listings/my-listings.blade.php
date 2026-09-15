<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mani sludinājumi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-900 antialiased">
    <nav class="bg-gray-900 text-white">
        <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
            <span class="text-lg font-bold">GearUp</span>
            <div class="flex items-center gap-4">
                @auth
                    <span class="text-sm">{{ Auth::user()->name }}</span>
                    <a href="{{ route('my-listings') }}" class="text-sm hover:underline">Mani sludinājumi</a>
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

        <div class="flex items-center justify-between mt-4 mb-8">
            <h1 class="text-3xl font-bold">Mani sludinājumi</h1>
            <a href="{{ route('listings.create') }}" class="px-4 py-2 text-sm rounded bg-gray-900 text-white hover:bg-gray-700">+ Pievienot sludinājumu</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($listings as $listing)
                <div class="border border-gray-200 rounded-lg p-5 flex flex-col">
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

                    <div class="mt-4 flex gap-3">
                        <a href="{{ route('listings.edit', $listing) }}" class="flex-1 block text-center border border-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-100">Rediģēt</a>
                        <form method="POST" action="{{ route('listings.destroy', $listing) }}" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full block text-center border border-red-300 text-red-600 px-4 py-2 rounded hover:bg-red-50">Dzēst</button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="col-span-full text-gray-500">Jums vēl nav sludinājumu</p>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $listings->links() }}
        </div>
    </div>
</body>
</html>