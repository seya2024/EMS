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
        Schema::create('group_permission', function (Blueprint $table) {

            $table->unsignedBigInteger('group_id')->nullable();
            $table->unsignedBigInteger('permission_id')->nullable();

            $table->foreign('group_id')
                ->references('id')
                ->on('user_groups')
                ->cascadeOnDelete()->nullable();

            $table->foreign('permission_id')
                ->references('id')
                ->on('permissions')
                ->cascadeOnDelete()->nullable();

            $table->primary(['group_id', 'permission_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_permission');
    }
};
