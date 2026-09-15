<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pievienot sludinājumu</title>
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
    <div class="max-w-2xl mx-auto px-4 py-10">
        <h1 class="text-3xl font-bold mb-8">Pievienot sludinājumu</h1>

        <form method="POST" action="{{ route('listings.store') }}" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="make" class="block text-sm font-medium text-gray-700 mb-1">Marka *</label>
                    <input type="text" name="make" id="make" value="{{ old('make') }}" required class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                    @error('make') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="model" class="block text-sm font-medium text-gray-700 mb-1">Modelis *</label>
                    <input type="text" name="model" id="model" value="{{ old('model') }}" required class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                    @error('model') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="year" class="block text-sm font-medium text-gray-700 mb-1">Gads *</label>
                    <input type="number" name="year" id="year" value="{{ old('year') }}" required min="1900" max="{{ date('Y') + 1 }}" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                    @error('year') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Cena (€) *</label>
                    <input type="number" name="price" id="price" value="{{ old('price') }}" required min="0" step="0.01" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                    @error('price') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="fuel_type" class="block text-sm font-medium text-gray-700 mb-1">Degvielas tips *</label>
                    <select name="fuel_type" id="fuel_type" required class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                        <option value="">Izvēlies</option>
                        <option value="benzīns" @selected(old('fuel_type') === 'benzīns')>Benzīns</option>
                        <option value="dīzelis" @selected(old('fuel_type') === 'dīzelis')>Dīzelis</option>
                        <option value="elektro" @selected(old('fuel_type') === 'elektro')>Elektro</option>
                        <option value="hibrīds" @selected(old('fuel_type') === 'hibrīds')>Hibrīds</option>
                    </select>
                    @error('fuel_type') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="engine_volume" class="block text-sm font-medium text-gray-700 mb-1">Motora tilpums (l)</label>
                    <input type="number" step="0.1" name="engine_volume" id="engine_volume" value="{{ old('engine_volume') }}" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                    @error('engine_volume') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="mileage" class="block text-sm font-medium text-gray-700 mb-1">Nobraukums (km) *</label>
                    <input type="number" name="mileage" id="mileage" value="{{ old('mileage') }}" required min="0" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                    @error('mileage') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="vin" class="block text-sm font-medium text-gray-700 mb-1">VIN</label>
                    <input type="text" name="vin" id="vin" value="{{ old('vin') }}" maxlength="17" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                    @error('vin') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="car_number" class="block text-sm font-medium text-gray-700 mb-1">Reģ. numurs</label>
                    <input type="text" name="car_number" id="car_number" value="{{ old('car_number') }}" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                    @error('car_number') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Tālrunis</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                    @error('phone') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Apraksts</label>
                <textarea name="description" id="description" rows="4" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">{{ old('description') }}</textarea>
                @error('description') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('my-listings') }}" class="px-4 py-2 text-sm rounded border border-gray-300 hover:bg-gray-100">Atcelt</a>
                <button type="submit" class="px-6 py-2 text-sm rounded bg-gray-900 text-white hover:bg-gray-700">Publicēt sludinājumu</button>
            </div>
        </form>
    </div>
</body>
</html>