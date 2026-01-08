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
        Schema::create('activity_reports', function (Blueprint $table) {
            $table->id();

            $table->foreignId('task_id')
                ->constrained()->nullable();

            $table->foreignId('deliverable_id')
                ->constrained()->nullable();

            $table->foreignId('task_giver_id')->constrained('o_u_s')->onDelete('cascade');

            $table->foreignId('district_id')
                ->constrained()->nullable();

            $table->string('status')->nullable();
            $table->text('description')->nullable()->nullable();
            $table->date('report_date')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_reports');
    }
};
