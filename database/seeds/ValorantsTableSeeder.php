<?php

use Illuminate\Database\Seeder;
use App\Valorant;

class ValorantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Valorant::create([
            'id' => '1',
            'rank' => 'radiant',
        ]);
        Valorant::create([
            'id' => '2',
            'rank' => 'immortal',
        ]);
        Valorant::create([
            'id' => '3',
            'rank' => 'ascendant',
        ]);
        Valorant::create([
            'id' => '4',
            'rank' => 'diamond',
        ]);
        Valorant::create([
            'id' => '5',
            'rank' => 'platinum',
        ]);
        Valorant::create([
            'id' => '6',
            'rank' => 'gold',
        ]);
        Valorant::create([
            'id' => '7',
            'rank' => 'silver',
        ]);
        Valorant::create([
            'id' => '8',
            'rank' => 'bronze',
        ]);
        Valorant::create([
            'id' => '9',
            'rank' => 'iron',
        ]);
        Valorant::create([
            'id' => '10',
            'rank' => 'free',
        ]);
    }
}
