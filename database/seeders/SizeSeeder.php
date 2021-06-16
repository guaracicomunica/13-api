<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Size;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sizes = ['Pequeno', 'Médio', 'Grande'];

        foreach($sizes as $size) {
            Size::create(['name' => $size]);
        }
    }
}
