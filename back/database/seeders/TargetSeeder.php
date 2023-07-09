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
        Target::query()->firstOrCreate(
            [
                'title' => 'главный'
            ]
        );
        Target::query()->firstOrCreate(
            [
                'title' => 'о нас'
            ]
        );
        Target::query()->firstOrCreate(
            [
                'title' => 'доставка'
            ]
        );
    }
}
