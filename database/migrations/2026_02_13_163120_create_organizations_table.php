<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('name');
            $table->string('slug')->unique();

            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('website')->nullable();
            $table->string('phone')->nullable();
            $table->text('description')->nullable();

            // агрегаты для карточек (быстро отдавать рейтинг/счётчик)
            $table->unsignedInteger('reviews_count')->default(0);
            $table->decimal('rating_avg', 3, 2)->default(0); // 0.00..5.00

            $table->timestamps();

            $table->index(['category_id', 'rating_avg']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
