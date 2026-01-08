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
        Schema::create('d_o_b_s', function (Blueprint $table) {
            $table->id();
            $table->string('model')->nullable();
            $table->string('value')->nullable();
            $table->string('service_no')->unique()->nullable();
            $table->string('serial')->unique()->nullable();
            $table->string('iccid')->unique()->nullable();
            // $table->string('quantity')->default('0');
            // $table->string('unit')->default('pcs');  //pcs, meter, kg

            $table->foreignId('branch_id')->constrained()->cascadeOnDelete()->nullable();
            $table->string('network_type')->nullable();
            $table->string('status')->nullable();
            //  $table->morphs('owner');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('d_o_b_s');
    }
};
