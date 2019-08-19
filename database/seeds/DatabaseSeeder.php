<?php

use Illuminate\Database\Seeder;

use App\Developer;
use App\Project;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Developer::truncate();
        Project::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $this->call(DeveloperTableSeeder::class);
        $this->call(ProjectTableSeeder::class);
    }
}
