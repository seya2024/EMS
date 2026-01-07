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
        Schema::create('asset_disposals', function (Blueprint $table) {
            $table->id();
            $table->string('asset_type');      // computer, printer, scanner, etc.
            $table->unsignedBigInteger('asset_id');
            $table->foreignId('branch_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('disposed_by')->constrained('users');
            $table->timestamp('disposed_at');
            $table->string('status')->default('disposed');
            $table->text('reason');
            $table->timestamps();
            $table->index(['asset_type', 'asset_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_disposals');
    }
};

Schema::create('asset_disposals', function (Blueprint $table) {});
