<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Seleção Brasileira',
                'name' => 'Seleção Europeia',
                'name' => 'Seleção Tailandesa',
            ],
        ];

        foreach($categories as $category) {
            Category::create([
                'name' => $category['name'],
            ]);
        }
    }
}
