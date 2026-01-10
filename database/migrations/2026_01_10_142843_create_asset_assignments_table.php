<?php
// database/migrations/xxxx_xx_xx_create_asset_assignments_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('asset_assignments', function (Blueprint $table) {
            $table->id();

            $table->morphs('assetable');
            // assetable_id BIGINT
            // assetable_type VARCHAR

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('assigned_by')->constrained('users')->nullable();
            $table->foreignId('returned_by')->nullable()->constrained('users');

            $table->timestamp('assigned_at')->nullable();
            $table->timestamp('returned_at')->nullable();

            $table->string('condition_out')->nullable();
            $table->string('condition_in')->nullable();

            $table->timestamps();

            // only ONE active owner per asset
            $table->unique(['assetable_id', 'assetable_type', 'returned_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asset_assignments');
    }
};
