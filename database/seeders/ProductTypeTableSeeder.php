<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::statement("
        INSERT INTO `product_types` (`id`, `name`, `image`, `status`, `parent_id`, `created_at`, `updated_at`) VALUES
        (1, 'حبة', NULL, 1, NULL, '2024-03-24 11:53:17', '2024-03-24 11:53:17'),
        (2, 'كرتون', NULL, 1, NULL, '2024-03-24 11:53:17', '2024-03-24 11:53:17'),
        (3, 'كيس', NULL, 1, NULL, '2024-03-24 11:53:17', '2024-03-24 11:53:17');
        ");
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
