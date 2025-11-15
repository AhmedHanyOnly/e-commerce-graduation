<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\User;
use App\Models\Country;
use App\Models\Product;
use App\Models\Department;
use App\Models\Relationship;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123456'),
            'type' => 'admin',

        ]);
        $vendor = User::create([
            'name' => 'مزود تجريبي',
            'type' => 'vendor',
            'email' => 'vendor@vendor.com',
            'password' => Hash::make('123456'),
            'active' => 1,
            'city_id' => 1,
            'longitude' => '48.620728',
            'latitude' => '24.601960',
            'commercial_record_number' => '123123123',
            'bank_account' => '123123123123',
            'neighborhood_id' => 1,
        ]);
        //         DB::statement("
        //         INSERT INTO `users` (`id`, `role_id`, `name`, `type`, `email`, `phone`, `image`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `active`, `city_id`, `longitude`, `latitude`, `commercial_record_image`, `commercial_record_number`, `bank_account`, `neighborhood_id`, `logo`, `car_name`, `car_model`, `can_serve`, `vendor_id`, `can_add_drivers`, `car_type_id`, `balance`, `from_time`, `to_time`) VALUES
        // (1, NULL, 'admin', 'admin', 'admin@admin.com', NULL, NULL, NULL, '$2y$10$6yDAPMdR0RLmfjgBSAcVPeHC/sCRIhgbM0QZYEkr7FX./u8KDyc56', NULL, '2024-03-24 11:53:16', '2024-04-01 09:19:56', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 10010, NULL, NULL),
        // (2, NULL, 'client', 'client', 'client@client.com', '111111111', 'clients/1711286330images.png', NULL, '$2y$10\$R7i/ijRIaAFPTL00kkhGseR1O8ukeNcQ7Pv.LdW.Gy3MIQjOer5BW', NULL, '2024-03-24 11:53:16', '2024-03-31 08:34:30', 1, 2, '44.583252', '26.195996', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1000000, NULL, NULL),
        // (3, NULL, 'driver', 'driver', 'driver@driver.com', '222222222', 'vendors/1711364615images.png', NULL, '$2y$10$2vDM6nQfmo7MiiFbErA.KuOUMEn7unQ2cwlVgBuwLGC2OoRDCAVh.', NULL, '2024-03-24 11:53:16', '2024-03-30 09:13:13', 1, 2, '0.000000', '0.000000', NULL, NULL, NULL, 1, NULL, 'سوزوكى ', '2020', 'all', 4, 0, 2, 0, NULL, NULL),
        // (4, NULL, 'vendor', 'vendor', 'vendor@vendor.com', '333333333', 'vendors/1711364126images.png', NULL, '$2y$10\$RU6OR/FyjaKwHj/Wyt6U6.iZo/n5GckKpnRc2jZzN//P9OVNEj4g6', NULL, '2024-03-24 11:53:16', '2024-03-30 09:10:46', 1, 2, '25.213755', '31.437095', 'vendors/1711364126images.jpeg', '111111111111111', '1111111111110', 1, 'vendors/1711364126download.png', NULL, NULL, NULL, NULL, 0, NULL, 0, '08:00', '20:00'),
        // (5, NULL, 'عادل ', 'driver', 'an@admin.com', '2154', NULL, NULL, $2y$10\$tcNqNarzHsPgtN5cz2NGnesCMjm7f6GM5cki.RzzXoIBYZW7srl6S, NULL, '2024-03-24 13:32:51', '2024-03-25 09:39:12', 1, 2, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'سوزوكى ', '2020', 'all', NULL, 0, 2, 0, NULL, NULL),
        // (6, NULL, 'علاء', 'driver', 'a@admin.com', '0321', NULL, NULL, '$2y$10\$elVS72xobvdqmNqzgRW3a.TOL0CRb.lbrDa3hH0JNBjUMS217baUS', NULL, '2024-03-25 09:38:31', '2024-03-30 11:49:41', 1, 2, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'سوزوكى ', '2020', 'all', NULL, 0, 2, 0, NULL, NULL),
        // (7, NULL, 'احمد علي 14', 'driver', 'a@a.a', '012365400', NULL, NULL, NULL, NULL, '2024-03-25 09:49:19', '2024-03-30 09:17:05', 1, 2, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL);
        //         ");
        User::first()->update(['password' => Hash::make('123456')]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
