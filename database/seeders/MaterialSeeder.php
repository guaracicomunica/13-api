<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Material;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $materials = [
            [
                'name' => 'Algodão',
            ],
            [
                'name' => 'Poliéster',
            ],
        ];

        foreach($materials as $material) {
            Material::create([
                'name' => $material['name'],
            ]);
        }
    }
}
