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

        $motorcycles = [
            'Yamaha' => ['YZF-R1', 'MT-07', 'MT-09', 'XSR900', 'Tracer 700'],
            'Kawasaki' => ['Ninja 650', 'Z900', 'Versys 650', 'Vulcan S', 'KX450'],
            'Suzuki' => ['GSX-R750', 'SV650', 'V-Strom 650', 'Bandit 650', 'Hayabusa'],
            'Ducati' => ['Monster 821', 'Panigale V2', 'Multistrada 950', 'Scrambler 800', 'Supersport'],
            'KTM' => ['790 Duke', '1290 Super Duke', '390 Adventure', '890 Adventure', 'RC 390'],
            'Harley-Davidson' => ['Street 750', 'Iron 883', 'Sportster S', 'Fat Boy', 'Road King'],
        ];

        $fuelTypes = ['benzīns', 'dīzelis', 'elektro'];

        $vehicleTypes = ['auto', 'motocikls'];

        $makes = array_keys($models);

        $firstNames = ['Jānis', 'Māris', 'Andris', 'Pēteris', 'Oskars', 'Rolands', 'Kaspars', 'Ivars', 'Artūrs', 'Normunds', 'Guntars', 'Aivars', 'Edgars', 'Mārtiņš', 'Kristaps', 'Rihards', 'Valdis', 'Juris', 'Gatis', 'Reinis'];
        $lastNames = ['Bērziņš', 'Kalniņš', 'Ozoliņš', 'Liepiņš', 'Krūmiņš', 'Balodis', 'Zariņš', 'Ozols', 'Vītols', 'Pētersons', 'Grīnbergs', 'Jansons', 'Krastiņš', 'Sproģis', 'Lapiņš', 'Rudzītis', 'Puriņš', 'Zālītis', 'Celmiņš', 'Avotiņš'];


        for ($i = 0; $i < 20; $i++) {
            $vehicleType = $vehicleTypes[array_rand($vehicleTypes)];

            if ($vehicleType === 'motocikls') {
                $brands = array_keys($motorcycles);
                $make = $brands[array_rand($brands)];
                $model = $motorcycles[$make][array_rand($motorcycles[$make])];
            } else {
                $make = $makes[array_rand($makes)];
                $model = $models[$make][array_rand($models[$make])];
            }

            $engineVolume = $vehicleType === 'motocikls'
                ? rand(10, 130) / 100
                : rand(100, 500) / 100;

            $fuelType = $vehicleType === 'motocikls'
                ? 'benzīns'
                : $fuelTypes[array_rand($fuelTypes)];

            $price = $vehicleType === 'motocikls'
                ? rand(1500, 15000)
                : rand(5000, 50000);

            $mileage = $vehicleType === 'motocikls'
                ? rand(1000, 50000)
                : rand(10000, 200000);

            $firstName = $firstNames[$i];
            $lastName = $lastNames [$i];
            $email = strtolower($firstName . '.' . $lastName) . $i . '@gmail.com';

            $user = User::create([
                'name' => $firstName . ' ' . $lastName,
                'email' => $email,
                'password' => bcrypt('password'),
            ]);

            Listing::create([
                'user_id' => $user->id,
                'make' => $make,
                'model' => $model,
                'year' => rand(2015, 2023),
                'price' => $price,
                'fuel_type' => $fuelType,
                'mileage' => $mileage,
                'description' => 'Labi uzturēts ' . $make . ' ' . $model . ', serviss veikts regulāri. Bez avārijām, pirmais īpašnieks Latvijā.',
                'vin' => '1HGBH41JXMN109' . str_pad((string) $i, 3, '0', STR_PAD_LEFT),
                'car_number' => chr(65 + ($i % 23)) . 'B-' . rand(1000, 9999),
                'phone' => '+371 2' . str_pad((string) rand(10000000, 99999999), 8, '0', STR_PAD_LEFT),
                'vehicle_type' => $vehicleType,
                'engine_volume' => $engineVolume,
            ]);
        }
    }
}
