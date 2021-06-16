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
                'name' => 'Categoria X',
            ],
        ];

        foreach($categories as $category) {
            Category::create([
                'name' => $category['name'],
            ]);
        }
    }
}
