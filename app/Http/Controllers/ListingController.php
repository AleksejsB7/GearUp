<?php

namespace App\Http\Controllers;

use App\Models\Listing;

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
}
