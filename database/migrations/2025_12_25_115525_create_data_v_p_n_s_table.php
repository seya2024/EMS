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
        Schema::create('data_v_p_n_s', function (Blueprint $table) {
            $table->id();
            $table->string('serviceNo');
            $table->string('lANIp');
            $table->string('wanIp')->nullable();
            $table->string('account');
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
            $table->string('media')->nullable();
            $table->string('bandwidth')->nullable();
            $table->string('linkType')->nullable();
            $table->string('vlan')->nullable();
            $table->text('remark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_v_p_n_s');
    }
};
