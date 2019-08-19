<?php

use Illuminate\Database\Seeder;

use App\Project;
use App\Developer;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $availableDevIds = Developer::where('id', '>', 0)->pluck('id')->toArray();

        for ($i = 0; $i < 150; $i++) {
            Project::create([
                'name' => $faker->name,
                'client_name' => $faker->name,
                'lead_developer_id' => $availableDevIds[array_rand($availableDevIds, 1)],
                'slug' => Project::generateUniqueSlug(8) 
            ]);
        }
    }
}
