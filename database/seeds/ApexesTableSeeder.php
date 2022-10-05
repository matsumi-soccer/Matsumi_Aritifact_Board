<?php

use Illuminate\Database\Seeder;
use App\Apex;

class ApexesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Apex::create([
            'id' => '1',
            'rank' => 'predator',
            
        ]);
        Apex::create([
            'id' => '2',
            'rank' => 'master',
        ]);
        Apex::create([
            'id' => '3',
            'rank' => 'diamond',
        ]);
        Apex::create([
            'id' => '4',
            'rank' => 'platinum',
        ]);
        Apex::create([
            'id' => '5',
            'rank' => 'gold',
        ]);
        Apex::create([
            'id' => '6',
            'rank' => 'silver',
        ]);
        Apex::create([
            'id' => '7',
            'rank' => 'bronze',
        ]);
        Apex::create([
            'id' => '8',
            'rank' => 'rookie',
        ]);
        Apex::create([
            'id' => '9',
            'rank' => 'free',
        ]);
        
        
        
        
        
        
        
        
    }
}
