<?php

namespace Database\Seeders;

use App\Models\Target;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TargetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Target::factory()->create([
            'title' => 'главный'
        ]);
        Target::factory()->create([
            'title' => 'о нас'
        ]);
        Target::factory()->create([
            'title' => 'доставка'
        ]);
    }
}
