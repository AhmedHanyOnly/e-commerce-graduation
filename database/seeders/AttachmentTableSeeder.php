<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AttachmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement("
        INSERT INTO `attachments` (`id`, `file_type`, `file_id`, `path`, `mime`, `size`, `created_at`, `updated_at`) VALUES
        (1, 'App\\Models\\Product', 3, 'attachments/1711792496lwNatWBHTfbVqpNC89oitW9x6xVLq1J9d0uCjyFl.webp', 'image/webp', '30444', '2024-03-30 09:54:56', '2024-03-30 09:54:56'),
        (2, 'App\\Models\\Product', 4, 'attachments/1711792596pF6TGqOsFdhBEO7WWkARNS3urF9xrjI7ZKVYz2Ua.jpg', 'image/jpeg', '176464', '2024-03-30 09:56:36', '2024-03-30 09:56:36'),
        (3, 'App\\Models\\Product', 2, 'attachments/1711792762GW4y9RyvNmMAsuEhcx5DXfEpZJESlCDjryDQfp28.webp', 'image/webp', '177860', '2024-03-30 09:59:22', '2024-03-30 09:59:22'),
        (4, 'App\\Models\\Product', 11, 'attachments/17117968348.webp', 'image/webp', '891208', '2024-03-30 11:07:14', '2024-03-30 11:07:14'),
        (5, 'App\\Models\\Product', 12, 'attachments/1711797316ديدد.webp', 'image/webp', '55082', '2024-03-30 11:15:16', '2024-03-30 11:15:16'),
        (6, 'App\\Models\\Product', 12, 'attachments/1711797350ديدد.webp', 'image/webp', '55082', '2024-03-30 11:15:50', '2024-03-30 11:15:50'),
        (7, 'App\\Models\\Product', 13, 'attachments/1711797586مبيد.webp', 'image/webp', '291124', '2024-03-30 11:19:46', '2024-03-30 11:19:46'),
        (8, 'App\\Models\\Product', 14, 'attachments/1711797667u08FO1GJrrCpunVdPYNJnQ19l9REdOcfeyFiNg5K.webp', 'image/webp', '94100', '2024-03-30 11:21:07', '2024-03-30 11:21:07'),
        (9, 'App\\Models\\Product', 15, 'attachments/1711797810بط.webp', 'image/webp', '441334', '2024-03-30 11:23:30', '2024-03-30 11:23:30'),
        (10, 'App\\Models\\Product', 10, 'attachments/17117979007.webp', 'image/webp', '988564', '2024-03-30 11:25:00', '2024-03-30 11:25:00'),
        (11, 'App\\Models\\Product', 9, 'attachments/17117979276.webp', 'image/webp', '628198', '2024-03-30 11:25:27', '2024-03-30 11:25:27'),
        (12, 'App\\Models\\Product', 8, 'attachments/17117979634.webp', 'image/webp', '393310', '2024-03-30 11:26:03', '2024-03-30 11:26:03'),
        (13, 'App\\Models\\Product', 7, 'attachments/17117979953.webp', 'image/webp', '1033066', '2024-03-30 11:26:35', '2024-03-30 11:26:35'),
        (14, 'App\\Models\\Product', 6, 'attachments/17117980372.webp', 'image/webp', '1063384', '2024-03-30 11:27:17', '2024-03-30 11:27:17');

        ");
    }
}
