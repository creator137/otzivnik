<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();

            $table->foreignId('organization_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->unsignedTinyInteger('rating'); // 1..5
            $table->string('title')->nullable();
            $table->text('pros')->nullable();
            $table->text('cons')->nullable();
            $table->text('text');

            $table->string('author_name')->nullable();

            // для простого антиспама/лимитов (не храним ip в открытую)
            $table->string('ip_hash', 64)->nullable();

            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');

            $table->timestamps();

            $table->index(['organization_id', 'status']);
            $table->index(['status', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
