<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subject::insert([
            ['name' => 'رياضيات'],
            ['name' => 'لغة عربية'],
            ['name' => 'فيزياء'],
            ['name' => 'كيمياء'],
            ['name' => 'أحياء'],
        ]);
    }
}
