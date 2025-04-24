<?php

namespace Database\Seeders;

use App\Models\Dashboard\Emails;
use App\Models\Dashboard\Mailbox;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        if (Mailbox::count() == 0) {
            $faker = Faker::create('ar_SA'); // تحديد اللغة العربية
            for ($i = 0; $i <= 25; $i++) {
                Emails::create([
                    'email' => $faker->email(),
                ]);
            }


            for ($i = 0; $i <= 20; $i++) {
                Mailbox::create([
                    'from' => rand(1, 20),
                    'name' => $faker->name(), // اسم عربي
                    'subject' => mb_substr($faker->sentence(6), 0, 120), // عنوان عربي
                    'message' => $faker->paragraph() . ' ' . $faker->paragraph(), // رسالة عربية
                    'unix_time' => time()
                ]);
            }
        }
    }
}
