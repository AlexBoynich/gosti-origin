<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Metric;
use App\Models\Subcategory;
use App\Models\Target;
use App\Models\User;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
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
            PaymentMethodSeeder::class,
        ]);
    }
}
