<?php

use Illuminate\Database\Seeder;

use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Category::truncate();

       $faker = \Faker\Factory::create();

       // And now, let's create a few articles in our database:
       for ($i = 0; $i < 5; $i++) {
           Category::create([
               'name' => $faker->unique()->randomElement(array ('Cat-1','Cat-2', 'Cat-3', 'Cat-4', 'Cat-5'))
           ]);
       }
    }
}
