<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\ProductType;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product_types = [
            [
                'name' => 'Camisa',
            ],
        ];

        foreach($product_types as $product_type) {
            ProductType::create([
                'name' => $product_type['name'],
            ]);
        }
    }
}
