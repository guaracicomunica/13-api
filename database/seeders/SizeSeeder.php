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
        $roles = ['Pequeno', 'Médio', 'Grande'];

        foreach($roles as $role) {
            Size::create(['name' => $role]);
        }
    }
}
