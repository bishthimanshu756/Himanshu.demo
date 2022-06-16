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
            'password' => 'password',
            'email_status' => '1',
            'status' => '1',         
            'created_by'=> '1',
        ]);

        User::create([
            'role_id'=>'2',
            'first_name' => 'Sub',
            'last_name' => 'Admin',
            'email' => 'subadmin@gmail.com',
            'password' => 'password',
            'email_status' => '1',
            'status' => '1',         
            'created_by'=> '1',
        ]);

        User::create([
            'role_id'=>'2',
            'first_name' => 'Sub',
            'last_name' => 'Admin 2',
            'email' => 'subadmin2@gmail.com',
            'password' => 'password',
            'email_status' => '1',
            'status' => '1',         
            'created_by'=> '1',
        ]);

        User::create([
            'role_id'=>'3',
            'first_name' => 'Trainer',
            'last_name' => 'user',
            'email' => 'trainer@gmail.com',
            'password' => 'password',
            'email_status' => '1',
            'status' => '1',         
            'created_by'=> '2',
        ]);

        User::create([
            'role_id'=>'4',
            'first_name' => 'Employee',
            'last_name' => 'user',
            'email' => 'employee@gmail.com',
            'password' => 'password',
            'email_status' => '1',
            'status' => '1',         
            'created_by'=> '4',
        ]);
    }
}
