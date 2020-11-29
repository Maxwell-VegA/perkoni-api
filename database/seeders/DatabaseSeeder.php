<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
// use Illuminate\Foundation\Faker;
// use Faker\Generator as Faker;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // $this->call(ProductsTableSeeder::class);
        // $faker = Faker\Factory::create();
        DB::table('products')->insert([
            'user_id' => 1,
            'confirmed' => true,
            'title' => $faker->text(86),
            'base_price' => $faker->randomDigit(),
            'category' => $faker->word(),
            'description' => $faker->paragraph(),
            'taggs' => $faker->text(24),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
