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
            $table->id();

            $table->string('hardwareType');
            $table->string('pcModel');
            $table->string('tagNo');
            $table->string('serialNo')->unique();
            $table->string('harddiskSize');
            $table->string('ramSize');
            $table->string('speed');
            $table->string('quantity')->default('0');
            $table->string('unit')->default('pcs');  //pcs, meter, kg
            $table->decimal('price', 10, 2)->nullable();
            $table->string('os');
            $table->boolean('isActivated')->default(false);
            $table->string('IpAddress')->nullable();
            $table->string('hostName')->nullable();
            $table->string('status')->default('Active');

            // $table->morphs('owner');  // Polymorphic relation
            // $table->string('owner_type')->default('Unknown')->change();


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
