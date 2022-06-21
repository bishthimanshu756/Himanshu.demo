<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'user_id' => 1,
            'name' => 'Category1',
            'slug' => 'category-1',
            'status' => 1
        ]);

        Category::create([
            'user_id' => 2,
            'name' => 'Category2',
            'slug' => 'category-2',
            'status' => 1
        ]); 

        Category::create([
            'user_id' => 3,
            'name' => 'Category3',
            'slug' => 'category-3',
            'status' => 1
        ]);

        Category::create([
            'user_id' => 4,
            'name' => 'Category4',
            'slug' => 'category-4',
            'status' => 1
        ]);
    }
}
