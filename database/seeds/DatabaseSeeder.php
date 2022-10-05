<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       $this->call(ApexesTableSeeder::class); 
       $this->call(ValorantsTableSeeder::class); 
       $this->call(PubgsTableSeeder::class); 
    }
}
