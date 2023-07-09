<?php

namespace Database\Seeders;

use App\Models\ObtainingMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ObtainingMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ObtainingMethod::query()->firstOrCreate(
            [
                'title' => 'Доставка',
            ],
            [
                'price' => '150'
            ]
        );
        ObtainingMethod::query()->firstOrCreate(
            [
                'title' => 'Самомывоз',
            ],
            [
                'price' => '0'
            ]
        );
    }
}
