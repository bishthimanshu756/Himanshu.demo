<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
        ]);

        Role::create([
            'name' => 'Sub-admin',
            'slug' => 'sub-admin',
        ]);

        Role::create([
            'name' => 'Trainer',
            'slug' => 'trainer',
        ]);
        
        Role::create([
            'name' => 'Employee',
            'slug' => 'employee',
        ]);

    }
}
