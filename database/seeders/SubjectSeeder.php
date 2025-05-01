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
            ['name' => 'رياضيات', 'type'=>'كمي'],
            ['name' => 'لغة عربية' , 'type'=>'لفظي'],
            ['name' => 'فيزياء' , 'type'=>'كمي'],
            ['name' => 'كيمياء' , 'type'=>'كمي'],
            ['name' => 'أحياء' , 'type'=>'لفظي'],
            ['name' => 'انجليزي' , 'type'=>'لفظي'],
        ]);
    }
}
