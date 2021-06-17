<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = [
            [
                'name' => 'Puma',
            ],
            [
                'name' => 'Adidas',
            ],
            [
                'name' => 'Nike',
            ]
        ];

        foreach($brands as $brand) {
            Brand::create([
                'name' => $brand['name'],
            ]);
        }
    }
}
