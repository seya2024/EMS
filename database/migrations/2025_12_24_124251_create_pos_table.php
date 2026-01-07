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
            $table->string('model');
            $table->string('value');
            $table->string('tag')->unique();
            $table->string('serial')->unique();
            $table->string('service_no');
            $table->string('type');
            $table->string('merchant');
            // $table->string('quantity')->default('0');
            // $table->string('unit')->default('pcs');  //pcs, meter, kg
            //   $table->morphs('owner');
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
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
