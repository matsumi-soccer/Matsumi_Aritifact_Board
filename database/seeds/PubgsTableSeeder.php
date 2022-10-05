<?php

use Illuminate\Database\Seeder;
use App\Pubg;

class PubgsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pubg::create([
            'id' => '1',
            'rank' => 'grand master',
        ]);
        Pubg::create([
            'id' => '2',
            'rank' => 'master',
        ]);
        Pubg::create([
            'id' => '3',
            'rank' => 'elite',
        ]);
        Pubg::create([
            'id' => '4',
            'rank' => 'diamond',
        ]);
        Pubg::create([
            'id' => '5',
            'rank' => 'platinum',
        ]);
        Pubg::create([
            'id' => '6',
            'rank' => 'gold',
        ]);
        Pubg::create([
            'id' => '7',
            'rank' => 'silver',
        ]);
        Pubg::create([
            'id' => '8',
            'rank' => 'bronze',
        ]);
        Pubg::create([
            'id' => '9',
            'rank' => 'free',
        ]);
    }
}
