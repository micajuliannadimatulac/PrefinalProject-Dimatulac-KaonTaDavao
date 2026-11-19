<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();

            // Each dish belongs to one eatery.
            $table->foreignId('eatery_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('name');

            // Example: 85.00 pesos.
            $table->decimal('price', 8, 2);

            $table->boolean('is_bestseller')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dishes');
    }
};
