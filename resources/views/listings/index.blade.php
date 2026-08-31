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

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($listings as $listing)
                <div class="border border-gray-200 rounded-lg p-5 flex flex-col">
                    <h2 class="text-xl font-semibold">{{ $listing->make }} {{ $listing->model }}</h2>
                    <p class="mt-2 text-gray-700">Gads: {{ $listing->year }}</p>
                    <p class="text-gray-700">Cena: €{{ $listing->price }}</p>
                    <p class="text-gray-700">Degviela: {{ $listing->fuel_type }}</p>
                    <p class="text-gray-700">Nobraukums: {{ $listing->mileage }} km</p>

                    <button class="mt-auto mt-4 bg-gray-900 text-white px-4 py-2 rounded hover:bg-gray-700">
                        Skatīt
                    </button>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $listings->links() }}
        </div>
    </div>
</body>
</html>
