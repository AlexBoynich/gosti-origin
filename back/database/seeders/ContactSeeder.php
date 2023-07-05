<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contact::factory()->create([
            'phone' => '8(3822)50-99-90',
            'email' => 'gosti.cafe@mail.ru',
            'vk' => 'https://vk.com/cafegostitomsk',
            'whatsapp' => '8(3822)50-99-90',
            'gis' => 'https://2gis.ru/tomsk/search/томск%20гости/firm/70000001029574004/84.969226%2C56.47649?m=84.969257%2C56.476512%2F17.38',
            'address' => 'Томск, просп. Фрунзе, 90',
        ]);
    }
}
