<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\CategoriesSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            LanguageSeeder::class,
            PermissionSeeder::class, // Permission Will Set Admin Onwer
            CategoriesSeeder::class,
            SettingSeeder::class,
            MailsSeeder::class,
            SubjectSeeder::class,
            QustionSeeder::class,


        ]);
    }
}
