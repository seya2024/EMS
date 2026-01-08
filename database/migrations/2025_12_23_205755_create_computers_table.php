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
        Schema::create('computers', function (Blueprint $table) {
            $table->id(); // Primary key, auto-increment
            // $table->string('hardwareType');

            $table->foreignId('hardware_type_id')->nullable()
                ->constrained()
                ->cascadeOnDelete()->nullable();

            $table->foreignId('computer_model_id')
                ->constrained()
                ->cascadeOnDelete()->nullable();

            $table->string('tagNo')->nullable();
            $table->string('serialNo')->unique()->nullable();
            // Store size with units as strings
            $table->string('harddiskSize')->nullable(); // e.g., "1 TB"
            $table->string('ramSize')->nullable();      // e.g., "4 GB"
            $table->string('speed')->nullable();       // CPU details
            $table->string('isActiveAntivirus')->default('Active agent')->nullable(); // pcs, meter, kg
            $table->string('os')->nullable();
            $table->boolean('isActivated')->default(false)->nullable();
            $table->string('IpAddress')->nullable()->nullable();
            $table->string('hostName')->nullable()->nullable();
            $table->enum('status', ['Active', 'Working', 'Not Working', 'Functional'])->default('Active')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->onDelete('cascade')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('computers');
    }
};
