<?php

use Illuminate\Database\Seeder;

use App\Developer;

class DeveloperTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 150; $i++) {
            Developer::create([
                'name' => $faker->name,
                'type' => array_rand(Developer::getTypes(), 1),
                'slug' => Developer::generateUniqueSlug(8) 
            ]);
        }
    }
}
