<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            SubcategorySeeder::class,
            MetricSeeder::class,
            ObtainingMethodSeeder::class,
            SettingSeeder::class,
            ScheduleSeeder::class,
            DishSeeder::class,
            ContactSeeder::class,
            TargetSeeder::class,
            BlockSeeder::class,
        ]);
    }
}
