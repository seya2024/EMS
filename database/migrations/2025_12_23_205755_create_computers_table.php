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

            $table->foreignId('hardware_type_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('computer_model_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('tagNo');
            $table->string('serialNo')->unique();
            // Store size with units as strings
            $table->string('harddiskSize'); // e.g., "1 TB"
            $table->string('ramSize');      // e.g., "4 GB"
            $table->string('speed');        // CPU details
            $table->string('isActiveAntivirus')->default('Active agent')->nullable(); // pcs, meter, kg
            $table->string('os');
            $table->boolean('isActivated')->default(false);
            $table->string('IpAddress')->nullable();
            $table->string('hostName')->nullable();
            $table->enum('status', ['Active', 'Working', 'Not Working', 'Functional'])->default('Active');
            $table->foreignId('branch_id')->nullable()->constrained('branches')->onDelete('cascade');
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
