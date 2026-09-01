<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sludinājumi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-900 antialiased">
    <div class="max-w-6xl mx-auto px-4 py-10">
        <h1 class="text-3xl font-bold mb-8">Sludinājumi</h1>

        <form method="GET" action="{{ route('listings.index') }}" class="border border-gray-200 rounded-lg p-5 mb-8 grid grid-cols-2 md:grid-cols-4 gap-4">
            <div>
                <label for="vehicle_type" class="block text-sm font-medium text-gray-700 mb-1">Transporta veids</label>
                <select name="vehicle_type" id="vehicle_type" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                    <option value="">Visi</option>
                    <option value="auto" @selected(request('vehicle_type') === 'auto')>Auto</option>
                    <option value="motocikls" @selected(request('vehicle_type') === 'motocikls')>Motocikls</option>
                </select>
            </div>

            <div>
                <label for="make" class="block text-sm font-medium text-gray-700 mb-1">Marka</label>
                <input type="text" name="make" id="make" value="{{ request('make') }}" placeholder="Piem. BMW" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
            </div>

            <div>
                <label for="year_from" class="block text-sm font-medium text-gray-700 mb-1">Gads no</label>
                <input type="number" name="year_from" id="year_from" value="{{ request('year_from') }}" placeholder="2015" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
            </div>

            <div>
                <label for="year_to" class="block text-sm font-medium text-gray-700 mb-1">Gads līdz</label>
                <input type="number" name="year_to" id="year_to" value="{{ request('year_to') }}" placeholder="2023" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
            </div>

            <div>
                <label for="fuel_type" class="block text-sm font-medium text-gray-700 mb-1">Degviela</label>
                <select name="fuel_type" id="fuel_type" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                    <option value="">Visa</option>
                    <option value="benzīns" @selected(request('fuel_type') === 'benzīns')>Benzīns</option>
                    <option value="dīzelis" @selected(request('fuel_type') === 'dīzelis')>Dīzelis</option>
                    <option value="elektro" @selected(request('fuel_type') === 'elektro')>Elektro</option>
                    <option value="hibrīds" @selected(request('fuel_type') === 'hibrīds')>Hibrīds</option>
                </select>
            </div>

            <div>
                <label for="engine_from" class="block text-sm font-medium text-gray-700 mb-1">Dzinējs no (l)</label>
                <input type="number" step="0.1" name="engine_from" id="engine_from" value="{{ request('engine_from') }}" placeholder="1.0" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
            </div>

            <div>
                <label for="engine_to" class="block text-sm font-medium text-gray-700 mb-1">Dzinējs līdz (l)</label>
                <input type="number" step="0.1" name="engine_to" id="engine_to" value="{{ request('engine_to') }}" placeholder="3.0" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
            </div>

            <div>
                <label for="price_from" class="block text-sm font-medium text-gray-700 mb-1">Cena no (€)</label>
                <input type="number" name="price_from" id="price_from" value="{{ request('price_from') }}" placeholder="5000" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
            </div>

            <div>
                <label for="price_to" class="block text-sm font-medium text-gray-700 mb-1">Cena līdz (€)</label>
                <input type="number" name="price_to" id="price_to" value="{{ request('price_to') }}" placeholder="50000" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
            </div>

            <div>
                <label for="mileage_from" class="block text-sm font-medium text-gray-700 mb-1">Nobraukums no (km)</label>
                <input type="number" name="mileage_from" id="mileage_from" value="{{ request('mileage_from') }}" placeholder="10000" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
            </div>

            <div>
                <label for="mileage_to" class="block text-sm font-medium text-gray-700 mb-1">Nobraukums līdz (km)</label>
                <input type="number" name="mileage_to" id="mileage_to" value="{{ request('mileage_to') }}" placeholder="200000" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
            </div>

            <div class="col-span-2 md:col-span-4 flex items-end justify-end gap-3 pt-4">
                <a href="{{ route('listings.index') }}" class="px-4 py-2 text-sm rounded border border-gray-300 hover:bg-gray-100">Notīrīt</a>
                <button type="submit" class="px-4 py-2 text-sm rounded bg-gray-900 text-white hover:bg-gray-700">Meklēt</button>
            </div>
        </form>

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

                    <a href="{{ route('listings.show', $listing) }}" class="mt-auto mt-4 block text-center bg-gray-900 text-white px-4 py-2 rounded hover:bg-gray-700">
                        Skatīt
                    </a>
                </div>
            @empty
                <p class="col-span-full text-gray-500">Nav atrasts neviens sludinājums.</p>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $listings->links() }}
        </div>
    </div>
</body>
</html>
