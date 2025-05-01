<?php

namespace Database\Seeders;

use App\Models\Passage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PassageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            Passage::create([
                'subject_id' => rand(1, 5),
                'type' => $faker->randomElement(['لفظي', 'كمي']),
                'title' => $faker->sentence(10),
                'content' => $faker->sentence(100),
            ]);
        }

    }
}
