<?php

namespace Database\Seeders;

use anlutro\LaravelSettings\Facades\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settingsJson = file_get_contents(storage_path('settings.json'));

        $settings = json_decode($settingsJson, true);

        if ($settings) {
            foreach ($settings as $key => $value) {
                setting([$key => $value])->save();
            }
        }
    }
}
