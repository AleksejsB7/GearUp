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

        $firstNames = ['Jānis', 'Māris', 'Andris', 'Pēteris', 'Oskars', 'Rolands', 'Kaspars', 'Ivars', 'Artūrs', 'Normunds', 'Guntars', 'Aivars', 'Edgars', 'Mārtiņš', 'Kristaps', 'Rihards', 'Valdis', 'Juris', 'Gatis', 'Reinis'];
        $lastNames = ['Bērziņš', 'Kalniņš', 'Ozoliņš', 'Liepiņš', 'Krūmiņš', 'Balodis', 'Zariņš', 'Ozols', 'Vītols', 'Pētersons', 'Grīnbergs', 'Jansons', 'Krastiņš', 'Sproģis', 'Lapiņš', 'Rudzītis', 'Puriņš', 'Zālītis', 'Celmiņš', 'Avotiņš'];


        for ($i = 0; $i < 20; $i++) {
            $make = $makes[array_rand($makes)];
            $model = $models[$make][array_rand($models[$make])];

            $firstName = $firstNames[$i];
            $lastName = $lastNames[$i];
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
                'price' => rand(5000, 50000),
                'fuel_type' => $fuelTypes[array_rand($fuelTypes)],
                'mileage' => rand(10000, 200000),
                'description' => 'Labi uzturēts ' . $make . ' ' . $model . ', serviss veikts regulāri. Bez avārijām, pirmais īpašnieks Latvijā.',
                'vin' => '1HGBH41JXMN109' . str_pad((string) $i, 3, '0', STR_PAD_LEFT),
                'car_number' => chr(65 + ($i % 23)) . 'B-' . rand(1000, 9999),
                'phone' => '+371 2' . str_pad((string) rand(10000000, 99999999), 8, '0', STR_PAD_LEFT),
            ]);
        }
    }
}
