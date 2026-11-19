<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('features', function (Blueprint $table) {
            $table->id();

            // Examples: Halal, Budget Meal, Aircon.
            $table->string('name')->unique();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('features');
    }
};
