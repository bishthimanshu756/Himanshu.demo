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
            'first_name' => 'Admin',
            'last_name' => 'XYZ',
            'email' => 'admin@gmail.com',
            'number' => '1232667890', 
            'city' => 'Mohali',
            'password' => 'password',
            'created_by'=> '1'
        ]);

        User::create([
            'role_id'=>'2',
            'first_name' => 'Himanshu',
            'last_name' => 'Bisht',
            'email' => 'himanshu@gmail.com',
            'number' => '1235467890', 
            'city' => 'Haldwani',
            'password' => 'password',
            'created_by' => '1'
        ]);

        User::create([
            'role_id'=>'3',
            'first_name' => 'Trainer',
            'last_name' => 'Abc',
            'email' => 'trainer@gmail.com',
            'number' => '12326632490', 
            'city' => 'Chandigarh',
            'password' => 'password',
            'created_by' => '1'
        ]);

        User::create([
            'role_id'=>'4',
            'first_name' => 'Employee',
            'last_name' => 'Abc',
            'email' => 'employee@gmail.com',
            'number' => '1235432490', 
            'city' => 'Mohali',
            'password' => 'password',
            'created_by' => '1'
        ]);
    }
}
