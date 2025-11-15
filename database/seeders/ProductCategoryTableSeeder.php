<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::statement("
        INSERT INTO `product_categories` (`id`, `name`, `image`, `status`, `parent_id`, `created_at`, `updated_at`) VALUES
        (1, 'منتجات زراعية', NULL, 1, NULL, '2024-03-24 11:53:17', '2024-03-24 11:53:17'),
        (2, 'ادوات زراعية', 'product_categories/1711793284oGDLyVUOEsBB7I73ThfK2l0kHemFMsvtCuwWTKYa.webp', 1, NULL, '2024-03-30 10:08:04', '2024-03-30 10:08:04'),
        (3, 'الاسمدة ومحسنات التربة', NULL, 1, NULL, '2024-03-30 10:08:23', '2024-03-30 10:08:23'),
        (4, 'مكافحة الافات والحشرات', NULL, 1, NULL, '2024-03-30 10:08:41', '2024-03-30 10:08:41');
        ");
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
