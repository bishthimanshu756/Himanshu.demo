<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Team::create([
            'team_id' => 2,
            'user_id' => 4,
        ]);

        Team::create([
            'team_id' => 4,
            'user_id' => 5,
        ]);

    
    }
}
