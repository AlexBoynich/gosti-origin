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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title')
                ->comment('Наименование');
            $table->integer('priority')
                ->comment('Приоритет');
            $table->time('available_start')
                ->nullable()
                ->comment('Время, с которого категория доступна');
            $table->time('available_end')
                ->nullable()
                ->comment('Время, по которого категория доступна');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
