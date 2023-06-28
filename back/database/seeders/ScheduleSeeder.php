<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schedule::factory()->create([
            'time_span' => 'Вс - ЧТ 08.00 - 22.00'
        ]);
        Schedule::factory()->create([
            'time_span' => 'Пт - Сб 08.00 - 23.00'
        ]);
    }
}
