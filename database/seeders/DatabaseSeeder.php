<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            CategorySeeder::class,
            BrandSeeder::class,
            MaterialSeeder::class,
            SizeSeeder::class,
            ColorSeeder::class,
            ProductSeeder::class,
            OrderStatusSeeder::class,
            ProductSizeSeeder::class
        ]);
    }
}
