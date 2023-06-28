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
            'title' => 'Завтрак',
            'priority' => 1,
        ]);
        Category::factory()->create([
            'title' => 'Обед',
            'priority' => 2,
        ]);
        Category::factory()->create([
            'title' => 'Ужин',
            'priority' => 3,
        ]);
    }
}
