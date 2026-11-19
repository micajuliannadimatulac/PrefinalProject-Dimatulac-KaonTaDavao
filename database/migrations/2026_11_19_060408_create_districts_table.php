<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Store Davao City's districts.
        Schema::create('districts', function (Blueprint $table) {
            $table->id();

            // District names must be unique.
            $table->string('name')->unique();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        // Remove the districts table during rollback.
        Schema::dropIfExists('districts');
    }
};
