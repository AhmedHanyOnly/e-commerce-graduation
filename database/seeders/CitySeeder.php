<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\Program;
use App\Models\Neighborhood;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'جدة',
            ],
            [
                'name' => 'الرياض',
            ],
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        City::truncate();
        Program::truncate();
        foreach ($data as $item) {
            $city = City::create($item);
            Neighborhood::create(['name' => 'حي في ' . $item['name'], 'city_id' => $city->id]);
        }
        Program::create(['name' => 'برنامج 1']);
        Program::create(['name' => 'برنامج 2']);
        Program::create(['name' => 'برنامج 3']);
    }
}
