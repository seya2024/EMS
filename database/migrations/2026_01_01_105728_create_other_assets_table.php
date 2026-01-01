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
        Schema::create('other_assets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_class_id')
                ->constrained('asset_classes')
                ->cascadeOnDelete();

            $table->string('asset_number')->unique();
            $table->text('description')->nullable();
            $table->string('cost_center')->nullable();

            $table->foreignId('branch_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->decimal('asset_cost', 15, 2)->default(0);
            $table->decimal('depreciation_current_year', 15, 2)->default(0);

            $table->string('assigned_to')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('other_assets');
    }
};
