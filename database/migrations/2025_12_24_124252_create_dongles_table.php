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
        Schema::create('dongles', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->string('value');
            $table->string('serial')->unique();
            $table->string('imei')->unique();
            $table->string('iccid')->unique();
            $table->string('service_no');
            $table->string('network_type');
            $table->string('status');
            // $table->morphs('owner')
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dongles');
    }
};
