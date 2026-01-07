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
        Schema::create('asset_maintenances', function (Blueprint $table) {
            $table->id();
            $table->morphs('assetable'); // assetable_id, assetable_type
            $table->foreignId('branch_id')->constrained('branches')->cascadeOnDelete();
            $table->foreignId('ou_id')->constrained('o_u_s')->cascadeOnDelete();

            // $table->unsignedBigInteger('ou_id');
            // $table->foreign('ou_id')->references('id')->on('o_u_s')->onDelete('cascade');

            // $table->unsignedBigInteger('branch_id');
            // $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');

            $table->text('problem')->nullable();
            $table->date('sent_date');
            $table->date('return_date')->nullable();
            $table->enum('status', ['SENT', 'RECEIVED', 'IN_PROGRESS', 'CLOSED']);
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_maintenances');
    }
};
