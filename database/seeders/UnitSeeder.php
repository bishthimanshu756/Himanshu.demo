<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unit::create([
            'title' => 'Unit 1',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni quasi minus eaque suscipit eligendi. Vel nam unde voluptatem minus laboriosam. Alias error id quam distinctio labore quos deserunt rerum excepturi, qui suscipit harum ea officia nihil aspernatur! Ullam odio tempora porro tenetur voluptas reprehenderit facere sit beatae iusto corrupti. Quis.',
            'lesson_count' => '4',
        ]);

        Unit::create([
            'title' => 'Unit 2',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni quasi minus eaque suscipit eligendi. Vel nam unde voluptatem minus laboriosam. Alias error id quam distinctio labore quos deserunt rerum excepturi, qui suscipit harum ea officia nihil aspernatur! Ullam odio tempora porro tenetur voluptas reprehenderit facere sit beatae iusto corrupti. Quis.',
            'lesson_count' => '3',
        ]);

        Unit::create([
            'title' => 'Unit 3',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni quasi minus eaque suscipit eligendi. Vel nam unde voluptatem minus laboriosam. Alias error id quam distinctio labore quos deserunt rerum excepturi, qui suscipit harum ea officia nihil aspernatur! Ullam odio tempora porro tenetur voluptas reprehenderit facere sit beatae iusto corrupti. Quis.',
            'lesson_count' => '4',
        ]);
    }
}
