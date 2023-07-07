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
        /**Завтраки 1**/
        Subcategory::factory()->create([
            'title' => 'Каши',
            'priority' => 1,
            'category_id' => 1,
        ]);
        Subcategory::factory()->create([
            'title' => 'Драник',
            'priority' => 1,
            'category_id' => 1,
        ]);
        Subcategory::factory()->create([
            'title' => 'Сырники',
            'priority' => 1,
            'category_id' => 1,
        ]);
        Subcategory::factory()->create([
            'title' => 'Блюда из яиц',
            'priority' => 1,
            'category_id' => 1,
        ]);
        Subcategory::factory()->create([
            'title' => 'Блины',
            'priority' => 1,
            'category_id' => 1,
        ]);
        Subcategory::factory()->create([
            'title' => 'Тосты и сендвичи',
            'priority' => 1,
            'category_id' => 1,
        ]);
        Subcategory::factory()->create([
            'title' => 'Сборные завтраки',
            'priority' => 1,
            'category_id' => 1,
        ]);

        /**Лавка 2**/
        Subcategory::factory()->create([
            'title' => 'Приготовленное',
            'priority' => 1,
            'category_id' => 4,
        ]);
        Subcategory::factory()->create([
            'title' => 'Из заморозки',
            'priority' => 1,
            'category_id' => 4,
        ]);

        /**Основное меню**/
        Subcategory::factory()->create([
            'title' => 'Салаты',
            'priority' => 1,
            'category_id' => 3,
        ]);
        Subcategory::factory()->create([
            'title' => 'Закуски',
            'priority' => 1,
            'category_id' => 3,
        ]);
        Subcategory::factory()->create([
            'title' => 'Вторые блюда',
            'priority' => 1,
            'category_id' => 3,
        ]);
        Subcategory::factory()->create([
            'title' => 'Супы',
            'priority' => 1,
            'category_id' => 3,
        ]);
        Subcategory::factory()->create([
            'title' => 'Гарниры',
            'priority' => 1,
            'category_id' => 3,
        ]);
        Subcategory::factory()->create([
            'title' => 'Детское меню',
            'priority' => 1,
            'category_id' => 3,
        ]);
        Subcategory::factory()->create([
            'title' => 'Добавки',
            'priority' => 1,
            'category_id' => 3,
        ]);

        /**Бизнес-ланч**/
        Subcategory::factory()->create([
            'title' => 'Салаты',
            'priority' => 1,
            'category_id' => 2,
        ]);
        Subcategory::factory()->create([
            'title' => 'Супы',
            'priority' => 1,
            'category_id' => 2,
        ]);
        Subcategory::factory()->create([
            'title' => 'Горячее',
            'priority' => 1,
            'category_id' => 2,
        ]);
    }
}
