<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Questions\QuestionsCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



        if (QuestionsCategory::count() == 0) {
            $categories = [
                // القسم الكمي
                ['name' => 'الحساب', 'type' => 'كمي'],
                ['name' => 'الجبر', 'type' => 'كمي'],
                ['name' => 'الهندسة', 'type' => 'كمي'],
                ['name' => 'الإحصاء والاحتمالات', 'type' => 'كمي'],
                ['name' => 'التحليل والمنطق', 'type' => 'كمي'],

                // القسم اللفظي
                ['name' => 'استيعاب المقروء', 'type' => 'لفظي'],
                ['name' => 'التناظر اللفظي', 'type' => 'لفظي'],
                ['name' => 'إكمال الجمل', 'type' => 'لفظي'],
                ['name' => 'الخطأ السياقي', 'type' => 'لفظي'],
                ['name' => 'الارتباط والاختلاف', 'type' => 'لفظي'],
                ['name' => 'المفرد والجمع', 'type' => 'لفظي'],
            ];

            foreach ($categories as $category) {
                QuestionsCategory::create($category);
            }
        }
    }
}
