<?php

namespace Database\Seeders;

use App\Models\Dish;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * Категория Завтраки
         **/
        /**Подкатегория Каши**/
        Dish::query()->firstOrCreate(
            [
                'title' => 'Каша овсяная',
            ],
            [
                'price' => '24900',
                'calorie' => '200',
                'proteins' => '90',
                'fats' => '10',
                'carbohydrates' => '190',
                'composition' => 'Овсянка с бананами',
                'is_available' => true,
                'sugar' => true,
                'lactose' => true,
                'gluten' => true,
                'metric_value' => 200,
                'metric_id' => 3,
                'subcategory_id' => 1,
            ]
        );
        Dish::query()->firstOrCreate(
            [
                'title' => 'Каша гречневая',
            ],
            [
                'price' => '7832',
                'calorie' => '42',
                'proteins' => '90',
                'fats' => '10',
                'carbohydrates' => '190',
                'composition' => 'Каша из гречи',
                'is_available' => true,
                'sugar' => true,
                'lactose' => false,
                'gluten' => true,
                'metric_value' => 200,
                'metric_id' => 3,
                'subcategory_id' => 1,
            ]);
        Dish::query()->firstOrCreate(
            [
                'title' => 'Каша манная',
            ],
            [
                'price' => '7832',
                'calorie' => '42',
                'proteins' => '90',
                'fats' => '10',
                'carbohydrates' => '190',
                'composition' => 'Каша из маны небесной',
                'is_available' => true,
                'sugar' => true,
                'lactose' => true,
                'gluten' => false,
                'metric_value' => 200,
                'metric_id' => 3,
                'subcategory_id' => 1,
            ]);
        Dish::query()->firstOrCreate(
            [
                'title' => 'Каша пшенная',
            ],
            [
                'price' => '7832',
                'calorie' => '42',
                'proteins' => '90',
                'fats' => '10',
                'carbohydrates' => '190',
                'composition' => 'Каша из пшена',
                'is_available' => true,
                'sugar' => false,
                'lactose' => true,
                'gluten' => true,
                'metric_value' => 200,
                'metric_id' => 3,
                'subcategory_id' => 1,
            ]);

        /**Подкатегория Драники**/
        Dish::query()->firstOrCreate(
            [
                'title' => 'Драники со сметаной',
            ],
            [
                'price' => '16900',
                'calorie' => '250',
                'proteins' => '200',
                'fats' => '50',
                'carbohydrates' => '90',
                'composition' => 'Драники со сметаной',
                'is_available' => true,
                'sugar' => false,
                'lactose' => true,
                'gluten' => false,
                'metric_value' => 170,
                'metric_id' => 3,
                'subcategory_id' => 2,
            ]);

        /**Подкатегория Сырники**/
        Dish::query()->firstOrCreate(
            [
                'title' => 'Медовые сырники',
            ],
            [
                'price' => '19900',
                'calorie' => '290',
                'proteins' => '90',
                'fats' => '150',
                'carbohydrates' => '250',
                'composition' => 'Сырники с мёдом',
                'is_available' => true,
                'sugar' => false,
                'lactose' => true,
                'gluten' => true,
                'metric_value' => 150,
                'metric_id' => 3,
                'subcategory_id' => 3,
            ]);

        /**Подкатегория Блюда из яиц**/
        Dish::query()->firstOrCreate(
            [
                'title' => 'Омлет',
            ],
            [
                'price' => '9900',
                'calorie' => '10',
                'proteins' => '5',
                'fats' => '0',
                'carbohydrates' => '0',
                'composition' => 'Омлет',
                'is_available' => true,
                'sugar' => true,
                'lactose' => false,
                'gluten' => false,
                'metric_value' => 200,
                'metric_id' => 2,
                'subcategory_id' => 4,
            ]);

        /**
         * Категория Бизнес-ланч
         **/
        /**Подкатегория Салаты**/
        Dish::query()->firstOrCreate(
            [
                'title' => 'Цезарь',
            ],
            [
                'price' => '9900',
                'calorie' => '10',
                'proteins' => '5',
                'fats' => '0',
                'carbohydrates' => '0',
                'composition' => 'Цезарь',
                'is_available' => true,
                'sugar' => true,
                'lactose' => false,
                'gluten' => false,
                'metric_value' => 200,
                'metric_id' => 2,
                'subcategory_id' => 17,
            ]);

        /**
         * Категория Основное меню
         **/
        /**Подкатегория Салаты**/
        Dish::query()->firstOrCreate(
            [
                'title' => 'Оливье',
            ],
            [
                'price' => '9900',
                'calorie' => '10',
                'proteins' => '5',
                'fats' => '0',
                'carbohydrates' => '0',
                'composition' => 'Оливье',
                'is_available' => true,
                'sugar' => true,
                'lactose' => false,
                'gluten' => false,
                'metric_value' => 200,
                'metric_id' => 2,
                'subcategory_id' => 10,
            ]);

        /**
         * Категория лавка
         **/
        /**Подкатегория Приготовленное**/
        Dish::query()->firstOrCreate(
            [
                'title' => 'Что-то',
            ],
            [
                'price' => '9900',
                'calorie' => '10',
                'proteins' => '5',
                'fats' => '0',
                'carbohydrates' => '0',
                'composition' => 'Мы не знаем что это такое, если бы мы знали что это такое, мы не знаем что это такое',
                'is_available' => true,
                'sugar' => true,
                'lactose' => false,
                'gluten' => false,
                'metric_value' => 200,
                'metric_id' => 2,
                'subcategory_id' => 8,
            ]);
    }
}
