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
        <a href="{{ route('listings.index') }}" class="text-sm text-gray-600 hover:underline">&larr; Atpakaļ uz sludinājumiem</a>

        <h1 class="text-3xl font-bold mt-4">{{ $listing->make }} {{ $listing->model }} ({{ $listing->year }})</h1>

        @auth
            <form method="POST" action="{{ $isSaved ? route('listings.unsave', $listing) : route('listings.save', $listing) }}" class="mt-4">
                @csrf
                @if ($isSaved)
                    @method('DELETE')
                @endif

                <button type="submit" class="px-5 py-2 text-sm rounded {{ $isSaved ? 'border border-gray-300 text-gray-700 hover:bg-gray-100' : 'bg-gray-900 text-white hover:bg-gray-700' }}">
                    {{ $isSaved ? 'Noņemt no saglabātajiem' : 'Saglabāt' }}
                </button>
            </form>
        @endauth

        <div class="mt-6">
            @if ($listing->images->isNotEmpty())
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach ($listing->images as $image)
                        <img src="{{ Storage::url($image->image_path) }}"
                             alt="{{ $listing->make }} {{ $listing->model }} — {{ $loop->iteration }}"
                             class="w-full h-56 object-cover rounded-lg border border-gray-200">
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 border border-gray-200 rounded-lg p-6 text-center">Nav bilžu</p>
            @endif
        </div>

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
