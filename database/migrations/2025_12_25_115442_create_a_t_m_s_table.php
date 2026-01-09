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
        Schema::create('a_t_m_s', function (Blueprint $table) {
            $table->id();
            $table->string('terminal')->nullable();
            $table->string('name')->nullable();
            $table->string('os')->nullable();
            $table->string('type')->nullable();
            $table->string('location')->nullable();
            $table->string('design')->nullable();
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete()->nullable();
            $table->string('ipAddress')->nullable();
            $table->string('networkType')->nullable()->default('Broadband');
            $table->text('remark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('a_t_m_s');
    }
};
