<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('eateries', function (Blueprint $table) {
            $table->id();

            // Every eatery belongs to one district.
            $table->foreignId('district_id')
                ->constrained()
                ->cascadeOnDelete();

            // Name and URL slug must be unique.
            $table->string('name', 100)->unique();
            $table->string('slug')->unique();

            $table->string('address');

            // Allowed values: budget, mid, splurge.
            $table->string('price_range');

            // Specialty is optional.
            $table->string('specialty')->nullable();

            // New eateries are open by default.
            $table->boolean('is_open')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('eateries');
    }
};
