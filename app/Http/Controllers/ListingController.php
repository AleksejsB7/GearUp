<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index()
    {
        $listings = Listing::query()
            ->when(request('vehicle_type'), fn ($q, $vt) => $q->where('vehicle_type', $vt))
            ->when(request('make'), fn ($q, $make) => $q->where('make', 'like', "%{$make}%"))
            ->when(request('year_from'), fn ($q, $year) => $q->where('year', '>=', $year))
            ->when(request('year_to'), fn ($q, $year) => $q->where('year', '<=', $year))
            ->when(request('fuel_type'), fn ($q, $ft) => $q->where('fuel_type', $ft))
            ->when(request('price_from'), fn ($q, $price) => $q->where('price', '>=', $price))
            ->when(request('price_to'), fn ($q, $price) => $q->where('price', '<=', $price))
            ->when(request('mileage_from'), fn ($q, $km) => $q->where('mileage', '>=', $km))
            ->when(request('mileage_to'), fn ($q, $km) => $q->where('mileage', '<=', $km))
            ->when(request('engine_from'), fn ($q, $vol) => $q->where('engine_volume', '>=', $vol))
            ->when(request('engine_to'), fn ($q, $vol) => $q->where('engine_volume', '<=', $vol))
            ->paginate(12)
            ->withQueryString();

        return view('listings.index', compact('listings'));
    }

    public function show(Listing $listing)
    {
        return view('listings.show', compact('listing'));
    }

    public function create()
    {
        return view('listings.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'make'           => ['required', 'string', 'max:255'],
            'model'          => ['required', 'string', 'max:255'],
            'year'           => ['required', 'integer', 'min:1900', 'max:' . (date('Y') + 1)],
            'price'          => ['required', 'numeric', 'min:0'],
            'fuel_type'      => ['required', 'in:benzīns,dīzelis,elektro,hibrīds'],
            'mileage'        => ['required', 'integer', 'min:0'],
            'engine_volume'  => ['nullable', 'numeric', 'min:0'],
            'vin'            => ['nullable', 'string', 'max:17'],
            'car_number'     => ['nullable', 'string', 'max:20'],
            'phone'          => ['nullable', 'string', 'max:30'],
            'description'    => ['nullable', 'string'],
        ]);

        auth()->user()->listings()->create($data);

        return redirect()->route('my-listings');
    }

    public function myListings()
    {
        $listings = auth()->user()
            ->listings()
            ->paginate(12);

        return view('listings.my-listings', compact('listings'));
    }
}
