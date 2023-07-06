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
            'whatsapp' => 'https://wa.me/79138209990',
            'gis' => 'https://yandex.ru/maps/org/gosti/228700453605/?ll=84.969567%2C56.476587&z=16.77',
            'address' => 'Томск, просп. Фрунзе, 90',
        ]);
    }
}
