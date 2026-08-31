<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listings</title>
</head>
<body>
    <h1>Listings</h1>

    @foreach ($listings as $listing)
        <div>
            <h2>{{ $listing->make }} {{ $listing->model }}</h2>
            <p>Gads: {{ $listing->year }}</p>
            <p>Cena: €{{ $listing->price }}</p>
            <p>Degvielas tips: {{ $listing->fuel_type }}</p>
            <p>Nobraukums: {{ $listing->mileage }} km</p>
        </div>
        <hr>
    @endforeach

    {{ $listings->links() }}
</body>
</html>
