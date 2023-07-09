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
        Subcategory::query()->firstOrCreate(
            [
                'title' => 'Каши',
            ],
            [
                'priority' => 1,
                'category_id' => 1,
            ]
        );
        Subcategory::query()->firstOrCreate(
            [
                'title' => 'Драник',
            ],
            [
                'priority' => 1,
                'category_id' => 1,
            ]
        );
        Subcategory::query()->firstOrCreate(
            [
                'title' => 'Сырники',
            ],
            [
                'priority' => 1,
                'category_id' => 1,
            ]
        );
        Subcategory::query()->firstOrCreate(
            [
                'title' => 'Блюда из яиц',
            ],
            [
                'priority' => 1,
                'category_id' => 1,
            ]
        );
        Subcategory::query()->firstOrCreate(
            [
                'title' => 'Блины',
            ],
            [
                'priority' => 1,
                'category_id' => 1,
            ]
        );
        Subcategory::query()->firstOrCreate(
            [
                'title' => 'Тосты и сендвичи',
            ],
            [
                'priority' => 1,
                'category_id' => 1,
            ]
        );
        Subcategory::query()->firstOrCreate(
            [
                'title' => 'Сборные завтраки',
            ],
            [
                'priority' => 1,
                'category_id' => 1,
            ]
        );

        /**Лавка 2**/
        Subcategory::query()->firstOrCreate(
            [
                'title' => 'Приготовленное',
            ],
            [
                'priority' => 1,
                'category_id' => 4,
            ]
        );
        Subcategory::query()->firstOrCreate(
            [
                'title' => 'Из заморозки',
            ],
            [
                'priority' => 1,
                'category_id' => 4,
            ]
        );

        /**Основное меню**/
        Subcategory::query()->firstOrCreate(
            [
                'title' => 'Салаты',
            ],
            [
                'priority' => 1,
                'category_id' => 3,
            ]
        );
        Subcategory::query()->firstOrCreate(
            [
                'title' => 'Закуски',
            ],
            [
                'priority' => 1,
                'category_id' => 3,
            ]
        );
        Subcategory::query()->firstOrCreate(
            [
                'title' => 'Вторые блюда',
            ],
            [
                'priority' => 1,
                'category_id' => 3,
            ]
        );
        Subcategory::query()->firstOrCreate(
            [
                'title' => 'Супы',
            ],
            [
                'priority' => 1,
                'category_id' => 3,
            ]
        );
        Subcategory::query()->firstOrCreate(
            [
                'title' => 'Гарниры',
            ],
            [
                'priority' => 1,
                'category_id' => 3,
            ]
        );
        Subcategory::query()->firstOrCreate(
            [
                'title' => 'Детское меню',
            ],
            [
                'priority' => 1,
                'category_id' => 3,
            ]
        );
        Subcategory::query()->firstOrCreate(
            [
                'title' => 'Добавки',
            ],
            [
                'priority' => 1,
                'category_id' => 3,
            ]
        );

        /**Бизнес-ланч**/
        Subcategory::query()->firstOrCreate(
            [
                'title' => 'Салаты',
            ],
            [
                'priority' => 1,
                'category_id' => 2,
            ]
        );
        Subcategory::query()->firstOrCreate(
            [
                'title' => 'Супы',
            ],
            [
                'priority' => 1,
                'category_id' => 2,
            ]
        );
        Subcategory::query()->firstOrCreate(
            [
                'title' => 'Горячее',
            ],
            [
                'priority' => 1,
                'category_id' => 2,
            ]
        );
    }
}
