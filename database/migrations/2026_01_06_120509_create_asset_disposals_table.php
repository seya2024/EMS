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
            $table->string('asset_type')->nullable();     // computer, printer, scanner, etc.
            $table->unsignedBigInteger('asset_id')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained()->nullOnDelete()->nullable();
            $table->foreignId('disposed_by')->constrained('users')->nullable();
            $table->timestamp('disposed_at')->nullable();
            $table->string('status')->default('disposed')->nullable();
            $table->text('reason')->nullable();
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
