<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::create([
            'title' => 'Admin Course',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente, in minus facere officia ex odit dicta dolores numquam cum libero nemo vero eius perferendis. Quos porro qui quas, laudantium labore recusandae vel esse dolor, asperiores non iste magni suscipit magnam illo, alias cum dolorem est vero iusto assumenda eius. Harum aspernatur in veniam eius ipsa voluptas magnam vero molestiae, distinctio dolorem? In blanditiis delectus illum fuga esse pariatur labore quisquam quae dolor eaque porro quas tempora doloribus hic, totam, molestias nulla alias odio magnam? Quidem temporibus harum nobis? Temporibus atque aspernatur sapiente aperiam, quam porro possimus doloremque modi unde quis!',
            'category_id' => '1',
            'level_id' => '1',
            'certificate' => '0',
            'user_id' => '1',
            'slug' => 'admin-course',
        ]);

        Course::create([
            'title' => 'Sub Admin Course',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente, in minus facere officia ex odit dicta dolores numquam cum libero nemo vero eius perferendis. Quos porro qui quas, laudantium labore recusandae vel esse dolor, asperiores non iste magni suscipit magnam illo, alias cum dolorem est vero iusto assumenda eius. Harum aspernatur in veniam eius ipsa voluptas magnam vero molestiae, distinctio dolorem? In blanditiis delectus illum fuga esse pariatur labore quisquam quae dolor eaque porro quas tempora doloribus hic, totam, molestias nulla alias odio magnam? Quidem temporibus harum nobis? Temporibus atque aspernatur sapiente aperiam, quam porro possimus doloremque modi unde quis!',
            'category_id' => '2',
            'level_id' => '2',
            'certificate' => '0',
            'user_id' => '2',
            'slug' => 'sub-admin-course'
        ]);

        Course::create([
            'title' => 'Trainer Course',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente, in minus facere officia ex odit dicta dolores numquam cum libero nemo vero eius perferendis. Quos porro qui quas, laudantium labore recusandae vel esse dolor, asperiores non iste magni suscipit magnam illo, alias cum dolorem est vero iusto assumenda eius. Harum aspernatur in veniam eius ipsa voluptas magnam vero molestiae, distinctio dolorem? In blanditiis delectus illum fuga esse pariatur labore quisquam quae dolor eaque porro quas tempora doloribus hic, totam, molestias nulla alias odio magnam? Quidem temporibus harum nobis? Temporibus atque aspernatur sapiente aperiam, quam porro possimus doloremque modi unde quis!',
            'category_id' => '3',
            'level_id' => '3',
            'certificate' => '0',
            'user_id' => '3',
            'slug' => 'trainer-course'
        ]);
    }
}
