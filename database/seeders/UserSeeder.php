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
            'slug' => 'admin-xyz',
            'email' => 'admin@gmail.com',
            'password' => 'admin123',
            'email_status' => '1',
            'status' => '1',         
            'created_by'=> '0',
        ]);

        User::create([
            'role_id'=>'2',
            'first_name' => 'Sub',
            'last_name' => 'Admin',
            'slug' => 'sub-admin',
            'email' => 'subadmin@gmail.com',
            'password' => 'subadmin123',
            'email_status' => '1',
            'status' => '1',         
            'created_by'=> '1',
        ]);

        User::create([
            'role_id'=>'2',
            'first_name' => 'Sub',
            'last_name' => 'Admin 2',
            'slug' => 'sub-admin-2',
            'email' => 'subadmin2@gmail.com',
            'password' => 'subadmin123',
            'email_status' => '1',
            'status' => '1',         
            'created_by'=> '1',
        ]);

        User::create([
            'role_id'=>'3',
            'first_name' => 'Trainer',
            'last_name' => 'user',
            'slug' => 'trainer-user',
            'email' => 'trainer@gmail.com',
            'password' => 'trainer123',
            'email_status' => '1',
            'status' => '1',         
            'created_by'=> '2',
        ]);

        User::create([
            'role_id'=>'4',
            'first_name' => 'Employee',
            'last_name' => 'user',
            'slug' => 'employee-user',
            'email' => 'employee@gmail.com',
            'password' => 'employee123',
            'email_status' => '1',
            'status' => '1',         
            'created_by'=> '4',
        ]);
    }
}
