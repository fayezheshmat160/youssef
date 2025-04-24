<?php

namespace Database\Seeders;

use App\Models\Dashboard\Settings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Settings::count() == 0) {

            Settings::create([
                'email' => env('MAIL_FROM_ADDRESS')
            ]);
        }
    }
}
