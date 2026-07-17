<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;

class CarSeeder extends Seeder
{
    public function run(): void
    {
        $cars = [
            [
                'brand'       => 'Apollo',
                'model'       => 'IE (Intensa Emozione)',
                'year'        => 2023,
                'price'       => 27000000000,
                'status'      => 'available',
                'description' => 'Apollo IE adalah hypercar terbatas yang diproduksi hanya 10 unit di seluruh dunia. Ditenagai mesin V12 naturally aspirated 6.3L yang menghasilkan 780 tenaga kuda, IE merupakan mahakarya rekayasa Jerman yang menggabungkan filosofi balap Le Mans dengan kemewahan tanpa kompromi.',
            ],
            [
                'brand'       => 'Pagani',
                'model'       => 'Huayra Roadster BC',
                'year'        => 2022,
                'price'       => 35000000000,
                'status'      => 'available',
                'description' => 'Pagani Huayra Roadster BC adalah puncak keahlian tangan seorang maestro. Diproduksi hanya 40 unit, setiap detail kendaraan ini dibuat secara manual dari bahan serat karbon titanium eksklusif. Mesin V12 twin-turbo Mercedes-AMG menghasilkan 800 tenaga kuda yang disalurkan dengan presisi bedah.',
            ],
            [
                'brand'       => 'Lamborghini',
                'model'       => 'Revuelto',
                'year'        => 2024,
                'price'       => 18500000000,
                'status'      => 'available',
                'description' => 'Lamborghini Revuelto adalah era baru dari ikon banteng dari Sant\'Agata. Sebagai penerus Aventador, Revuelto memadukan mesin V12 naturally aspirated 6.5L dengan tiga motor listrik, menghasilkan sistem hybrid plug-in pertama Lamborghini. Total output mencapai 1.015 tenaga kuda — kecepatan 0 hingga 100 km/h hanya dalam 2,5 detik.',
            ],
        ];

        foreach ($cars as $car) {
            Car::create($car);
        }
    }
}
