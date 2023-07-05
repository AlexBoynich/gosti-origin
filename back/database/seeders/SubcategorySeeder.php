<?php

namespace Database\Seeders;

use App\Models\Subcategory;
use Illuminate\Database\Seeder;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subcategory::factory()->create([
            'title' => 'Каши',
            'priority' => 1,
            'category_id' => 1,
        ]);
        Subcategory::factory()->create([
            'title' => 'Выпечка',
            'priority' => 3,
            'category_id' => 1,
        ]);
        Subcategory::factory()->create([
            'title' => 'Напитки',
            'priority' => 2,
            'category_id' => 1,
        ]);
        Subcategory::factory()->create([
            'title' => 'Другое',
            'priority' => 3,
            'category_id' => 1,
        ]);
    }
}
