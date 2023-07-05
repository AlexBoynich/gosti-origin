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
        Dish::factory()->create([
            'title' => 'Каша овсяная',
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
        ]);
        Dish::factory()->create([
            'title' => 'Омлет',
            'price' => '16900',
            'calorie' => '250',
            'proteins' => '200',
            'fats' => '50',
            'carbohydrates' => '90',
            'composition' => 'Омлет на перепелиных яйцах',
            'is_available' => true,
            'sugar' => false,
            'lactose' => true,
            'gluten' => false,
            'metric_value' => 170,
            'metric_id' => 3,
            'subcategory_id' => 4,
        ]);
        Dish::factory()->create([
            'title' => 'Сэндвич',
            'price' => '19900',
            'calorie' => '290',
            'proteins' => '90',
            'fats' => '150',
            'carbohydrates' => '250',
            'composition' => 'Сэндвич с ветчиной, сыром и помидорами',
            'is_available' => true,
            'sugar' => false,
            'lactose' => true,
            'gluten' => true,
            'metric_value' => 150,
            'metric_id' => 3,
            'subcategory_id' => 2,
        ]);
        Dish::factory()->create([
            'title' => 'Чай с облепихой',
            'price' => '9900',
            'calorie' => '10',
            'proteins' => '5',
            'fats' => '0',
            'carbohydrates' => '0',
            'composition' => 'Чай с облепихой',
            'is_available' => true,
            'sugar' => true,
            'lactose' => false,
            'gluten' => false,
            'metric_value' => 200,
            'metric_id' => 2,
            'subcategory_id' => 3,
        ]);
    }
}
