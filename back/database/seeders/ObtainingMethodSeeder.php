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
        ObtainingMethod::factory()->create([
            'title' => 'Доставка',
            'price' => '150'
        ]);

        ObtainingMethod::factory()->create([
            'title' => 'Самомывоз',
            'price' => '0'
        ]);
    }
}
