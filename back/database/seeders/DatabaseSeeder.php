<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('obtaining_method_orders')->truncate();
        DB::table('addresses')->truncate();
        DB::table('carts')->truncate();
        DB::table('orders')->truncate();
        DB::table('customers')->truncate();
        DB::table('dishes')->truncate();

        DB::table('blocks')->truncate();
        DB::table('contacts')->truncate();
        DB::table('settings')->truncate();
        DB::table('users')->truncate();

        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            SubcategorySeeder::class,
            MetricSeeder::class,
            ObtainingMethodSeeder::class,
            SettingSeeder::class,
            ContactSeeder::class,
            TargetSeeder::class,
            BlockSeeder::class,
            PaymentMethodSeeder::class,
        ]);
    }
}
