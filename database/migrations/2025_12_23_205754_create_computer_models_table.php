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
        Schema::create('computer_models', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->foreignId('hardware_type_id')->constrained()->cascadeOnDelete()->nulllable();
            $table->text('description')->nullable(); // optional description
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('computer_models');
    }
};
