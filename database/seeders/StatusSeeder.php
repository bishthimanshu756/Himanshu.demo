<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create([
            'name' => 'Published'
        ]);

        Status::create([
            'name' => 'Draft'
        ]);

        Status::create([
            'name' => 'Archived'
        ]);
    }
}
