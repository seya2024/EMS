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
            $table->string('terminal');
            $table->string('os');
            $table->string('type');
            $table->string('location');
            $table->string('design');
            //  $table->string('custodian')->nullable();
            $table->foreignId('custodian')->constrained('branches')->onDelete('cascade');
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
