<?php

namespace Database\Seeders;

use App\Models\Metric;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->truncate();
        User::query()->firstOrCreate([
            'name' => 'Администратор',
            'email' => 'gosti_cafe@mail.ru',
        ],[
            'password' => Hash::make('MMsis010616'),
            'is_admin' => true,
        ]);

        Metric::firstOrCreate([
            'title' => 'шт'
        ]);
    }
}
