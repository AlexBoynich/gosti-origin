<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory()->create([
            'title' => 'Завтраки',
            'priority' => 1,
            'weekday_available_start' => '8:00:00',
            'weekday_available_end' => '12:00:00',
            'weekend_available_start' => '8:00:00',
            'weekend_available_end' => '16:00:00',
        ]);
        Category::factory()->create([
            'title' => 'Бизнес-ланч',
            'priority' => 3,
            'weekday_available_start' => '12:00:00',
            'weekday_available_end' => '16:00:00',
        ]);
        Category::factory()->create([
            'title' => 'Основное меню',
            'priority' => 3,
        ]);
        Category::factory()->create([
            'title' => 'Лавка',
            'priority' => 2,
        ]);

    }
}
