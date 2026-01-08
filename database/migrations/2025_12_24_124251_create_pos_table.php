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
        Schema::create('pos', function (Blueprint $table) {
            $table->id();
            $table->string('model')->nullable();
            $table->string('value')->nullable();
            $table->string('tag')->unique()->nullable();
            $table->string('serial')->unique()->nullable();
            $table->string('service_no')->nullable();
            $table->string('type')->nullable();
            $table->string('merchant')->nullable();
            // $table->string('quantity')->default('0');
            // $table->string('unit')->default('pcs');  //pcs, meter, kg
            //   $table->morphs('owner');
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pos');
    }
};
