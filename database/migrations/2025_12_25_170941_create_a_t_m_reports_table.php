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
        Schema::create('a_t_m_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('custodian')->constrained('branches')->onDelete('cascade')->nullable();
            $table->foreignId('atm_id')->constrained('a_t_m_s')->onDelete('cascade')->nullable();
            $table->foreignId('downtime_reason_id')->constrained('downtime_reasons')->onDelete('cascade')->nullable();
            $table->string('action_taken')->nullable();
            $table->decimal('down_time_in_days', 5, 2)->nullable();
            $table->date('open_date')->nullable();

            $table->string('call_ID')->nullable();
            $table->string('TT')->nullable();

            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('closed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->date('close_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('a_t_m_reports');
    }
};
