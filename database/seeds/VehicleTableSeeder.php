<?php

use Illuminate\Database\Seeder;

use App\Vehicle;

class VehicleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Vehicle::truncate();

       $faker = \Faker\Factory::create();
       $faker->addProvider(new \Faker\Provider\Fakecar($faker));

       // And now, let's create a few articles in our database:
       for ($i = 0; $i < 20; $i++) {
           $v = $faker->vehicleArray();

           Vehicle::create([
               'product_id' => $faker->unique()->numerify('###-###-###'),
               'product_name' => $v['model'],
               'brand' => $v['brand'],
               'body_type' => $faker->vehicleType,
               'color' => $faker->randomElement(array ('White','Silver', 'Black', 'Dark Blue', 'Dark Gray', 'Red', 'Dark Green', 'Light Brown')),
               'no_of_doors' => $faker->randomElement(array ('2','4')),
               'item_condition' => $faker->randomElement(array ('Excellent','Very Good', 'Good', 'Bad')),
               'seating_capacity' => $faker->randomElement(array ('4','6', '8', '10')),
               'speed' => $faker->numerify("##.###"),
               'acceleration_time' => $faker->numerify("#.###"),
               'weight' => $faker->numerify("###.##"),
               'model_date' => $faker->date($format = 'Y-m-d'),
               'purchase_date' => $faker->date($format = 'Y-m-d'),
           ]);
       }
    }
}
