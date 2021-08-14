<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'description' => $this->faker->text,
            'price' => $this->faker->randomFloat(2, 9.99, 299.99),
            'brand_id' => $this->faker->numberBetween(1, 3),
            'material_id' => $this->faker->numberBetween(1, 2),
            'stars' => $this->faker->numberBetween(1, 5),
            'color_id' => $this->faker->numberBetween(1, 9),
            'product_type_id' => 1
        ];
    }
}
