<?php

namespace Database\Factories;

use App\Models\ProductSize;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductSizeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductSize::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => $this->faker->numberBetween(1, 1000),
            'size_id' => $this->faker->numberBetween(1, 3)
        ];
    }
}
