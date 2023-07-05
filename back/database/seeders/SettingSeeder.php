<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::factory()->create([
            'section'=> 'main',
            'key' => 'thresholdCost',
            'value' => '1000',
            'description' => 'Пороговая сумма заказа для расчёта стоимости доставки'
        ]);
    }
}
