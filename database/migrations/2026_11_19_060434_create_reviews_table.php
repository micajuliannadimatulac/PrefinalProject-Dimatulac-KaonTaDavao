<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();

            // Each review belongs to an eatery.
            $table->foreignId('eatery_id')
                ->constrained()
                ->cascadeOnDelete();

            // Each review is written by a seeded user.
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // Ratings will be validated from 1 to 5.
            $table->unsignedTinyInteger('rating');

            $table->text('body');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
