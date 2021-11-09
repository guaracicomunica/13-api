<?php

namespace Database\Seeders;

use App\Models\ProductType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([UserSeeder::class]);

        $this->call([
            RoleSeeder::class,
            CategorySeeder::class,
            BrandSeeder::class,
            MaterialSeeder::class,
            SizeSeeder::class,
            ColorSeeder::class,
            ProductTypeSeeder::class,
        ]);

        if (App::environment('local')) {
            $this->call([
                ProductSeeder::class,
                ProductSizeSeeder::class,
                ProductCategorySeeder::class
            ]);
        }
    }
}
