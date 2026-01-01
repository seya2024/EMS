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
            $table->string('model');
            $table->string('value');
            $table->string('service_no')->unique();
            $table->string('serial')->unique();
            $table->string('iccid')->unique();
            // $table->string('quantity')->default('0');
            // $table->string('unit')->default('pcs');  //pcs, meter, kg

            $table->string('network_type');
            $table->string('status');
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
