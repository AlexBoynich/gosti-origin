<?php

namespace Database\Seeders;

use App\Models\Metric;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MetricSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Metric::factory()->create([
            'title' => 'мл',
        ]);
        Metric::factory()->create([
            'title' => 'л',
        ]);
        Metric::factory()->create([
            'title' => 'г',
        ]);
        Metric::factory()->create([
            'title' => 'кг',
        ]);
    }
}
