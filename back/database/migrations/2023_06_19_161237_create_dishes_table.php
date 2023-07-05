<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();
            $table->string('title')
                ->comment('Наименование');
            $table->integer('price')
                ->comment('Цена');
            $table->integer('calorie')
                ->comment('Калории');
            $table->integer('proteins')
                ->comment('Белки');
            $table->integer('fats')
                ->comment('Жиры');
            $table->integer('carbohydrates')
                ->comment('Углеводы');
            $table->string('composition')
                ->comment('Состав');
            $table->boolean('is_available')
                ->comment('Доступно ли блюдо для заказа');
            $table->boolean('sugar')
                ->comment('Есть ли в блюде сахар');
            $table->boolean('lactose')
                ->comment('Есть ли в блюде лактоза');
            $table->boolean('gluten')
                ->comment('Есть ли в блюде глютен');
            $table->integer('metric_value')
                ->comment('Вес/объём блюда');
            $table->foreignId('subcategory_id')->constrained();
            $table->foreignId('metric_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dishes');
    }
};
