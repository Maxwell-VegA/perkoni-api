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
        $factory->define(App\Models\Product::class, function(Faker $faker){
            return [
                'user_id' => 1,
                'confirmed' => true,
                'title' => $faker->text(86),
                'base_price' => $faker->randomDigit(),
                'category' => $faker->word(),
                'description' => $faker->paragraph(),
                'taggs' => $faker->text(24),
                'created_at' => now(),
                'updated_at' => now(),
                
            ];
        });
    }
}
