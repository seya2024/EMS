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
        Schema::create('asset_transfers', function (Blueprint $table) {
            $table->id();
            // Computer, Printer, ATM, etc.
            $table->morphs('assetable'); // assetable_id, assetable_type
            $table->foreignId('from_branch_id')->constrained('branches')->cascadeOnDelete()->nullable();
            $table->foreignId('to_branch_id')->constrained('branches')->cascadeOnDelete()->nullable();


            $table->enum('action', [
                'handover',
                'takeover',
                'transfer',
                'disposal'
            ]);


            $table->foreignId('performed_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamp('performed_at');

            $table->text('remarks')->nullable();

            $table->timestamps();

            // $table->index(['asset_type', 'asset_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_transfers');
    }
};
