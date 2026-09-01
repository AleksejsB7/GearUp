<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $listing->make }} {{ $listing->model }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-900 antialiased">
    <div class="max-w-3xl mx-auto px-4 py-10">
        <a href="{{ route('listings.index') }}" class="text-sm text-gray-600 hover:underline">&larr; Atpakaļ</a>

        <h1 class="text-3xl font-bold mt-4">{{ $listing->make }} {{ $listing->model }} ({{ $listing->year }})</h1>

        <div class="mt-6 space-y-2 text-gray-700">
            <p><strong>Cena:</strong> €{{ $listing->price }}</p>
            <p><strong>Degvielas tips:</strong> {{ $listing->fuel_type }}</p>
            @if ($listing->engine_volume !== null)
                <p><strong>Motora tilpums:</strong> {{ $listing->engine_volume }} L</p>
            @endif
            <p><strong>Nobraukums:</strong> {{ $listing->mileage }} km</p>
            <p><strong>VIN kods:</strong> {{ $listing->vin }}</p>
            <p><strong>Reģistrācijas numurs:</strong> {{ $listing->car_number }}</p>
            <p><strong>Pārdevēja tālrunis:</strong> {{ $listing->phone }}</p>
        </div>

        <div class="mt-6">
            <h2 class="text-xl font-semibold">Apraksts</h2>
            <p class="mt-2 text-gray-700">{{ $listing->description }}</p>
        </div>

        <div class="mt-8 pt-4 border-t border-gray-200 text-gray-700">
            <p><strong>Pārdevējs:</strong> {{ $listing->user->name }}</p>
            <p><strong>Publicēts:</strong> {{ $listing->created_at->format('d.m.Y') }}</p>
        </div>
    </div>
</body>
</html>
