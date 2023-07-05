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
        ]);
        Category::factory()->create([
            'title' => 'Лавка',
            'priority' => 2,
        ]);
        Category::factory()->create([
            'title' => 'Основное меню',
            'priority' => 3,
        ]);
        Category::factory()->create([
            'title' => 'Бизнес-ланч',
            'priority' => 3,
        ]);
    }
}
