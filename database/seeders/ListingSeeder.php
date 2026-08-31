<?php

namespace Database\Seeders;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Seeder;

class ListingSeeder extends Seeder
{
    public function run(): void
    {
        $models = [
            'BMW' => ['3 Series', '5 Series', 'X3', 'X5', '1 Series'],
            'Audi' => ['A3', 'A4', 'A6', 'Q5', 'Q7'],
            'Toyota' => ['Corolla', 'Camry', 'RAV4', 'Highlander', 'Yaris'],
            'Volkswagen' => ['Golf', 'Passat', 'Tiguan', 'Polo', 'Touareg'],
            'Mercedes' => ['C-Class', 'E-Class', 'GLC', 'A-Class', 'GLE'],
            'Honda' => ['Civic', 'Accord', 'CR-V', 'HR-V', 'Jazz'],
        ];

        $fuelTypes = ['benzīns', 'dīzelis', 'elektro'];

        $makes = array_keys($models);

        for ($i = 0; $i < 20; $i++) {
            $make = $makes[array_rand($makes)];
            $model = $models[$make][array_rand($models[$make])];

            Listing::create([
                'user_id' => 1,
                'make' => $make,
                'model' => $model,
                'year' => rand(2015, 2023),
                'price' => rand(5000, 50000),
                'fuel_type' => $fuelTypes[array_rand($fuelTypes)],
                'mileage' => rand(10000, 200000),
                'description' => 'Labi uzturēts ' . $make . ' ' . $model . ', serviss veikts regulāri.',
            ]);
        }
    }
}
