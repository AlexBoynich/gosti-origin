<?php

namespace Database\Seeders;

use App\Models\Block;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Block::factory()->create([
            'title' => 'Мы - Гости',
            'description' => 'Наше городское кафе на каждый день для любимых завтраков, ланчей, ужинов с бокалом вина в уютной атмосфере!
Еда для нас не только про многогранность вкусов, но и про вдохновение, теплые эмоции и общение, которое мы разделяем вместе с вами!',
            'target_id' => 2
        ]);

        Block::factory()->create([
            'title' => 'Доставка',
            'description' => 'Выбирайте любимые блюда в каталоге и заказывайте их через нашу доставку по всему городу. Привезём свежую еду за 2 часа!',
            'target_id' => 3
        ]);
    }
}
