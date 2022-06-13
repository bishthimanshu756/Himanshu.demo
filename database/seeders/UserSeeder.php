<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'role_id'=>'1',
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'number' => '1232667890', 
            'city' => 'Mohali',
            'password' => 'password'
        ]);

        User::create([
            'role_id'=>'2',
            'name' => 'Himanshu',
            'email' => 'himanshu@gmail.com',
            'number' => '1235467890', 
            'city' => 'Haldwani',
            'password' => 'password'
        ]);

        User::create([
            'role_id'=>'3',
            'name' => 'trainer',
            'email' => 'trainer@gmail.com',
            'number' => '12326632490', 
            'city' => 'Chandigarh',
            'password' => 'password'
        ]);

        User::create([
            'role_id'=>'4',
            'name' => 'Employee',
            'email' => 'employee@gmail.com',
            'number' => '1235432490', 
            'city' => 'Mohali',
            'password' => 'password'
        ]);
    }
}
