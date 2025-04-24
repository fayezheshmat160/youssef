<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class QustionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 100; $i++) {
            Question::create([
                'subject_id' => rand(1, 5), // غيّر الـ IDs حسب الموجود فعليًا
               // 'type' => $faker->randomElement(['لفظئ', 'كمي']),
                'question' => $faker->sentence(10),
                'photo' => null, // أو استخدم صورة وهمية لو عايز
                'options' => json_encode([
                    'أ' => $faker->word,
                    'ب' => $faker->word,
                    'ج' => $faker->word,
                    'د' => $faker->word,
                ]),
                'correct_answer' => $faker->randomElement(['أ', 'ب', 'ج', 'د']),
                'explane_answer' => $faker->sentence(15),
                'notes' => $faker->optional()->sentence(8),
            ]);
        }

    }
}
