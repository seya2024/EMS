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
            $table->id();
            // $table->foreignId('group_id')->constrained()->cascadeOnDelete();
            // $table->foreignId('permission_id')->constrained()->cascadeOnDelete();


            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('permission_id');

            $table->timestamps();

            // Correct foreign keys
            $table->foreign('group_id')
                ->references('id')
                ->on('user_groups') // <-- not 'groups'
                ->cascadeOnDelete();

            $table->foreign('permission_id')
                ->references('id')
                ->on('permissions')
                ->cascadeOnDelete();


            // // Foreign keys
            // $table->foreign('group_id')
            //     ->references('id')
            //     ->on('user_groups')  // NOT 'groups'
            //     ->cascadeOnDelete();

            // $table->foreign('permission_id')
            //     ->references('id')
            //     ->on('permissions')
            //     ->cascadeOnDelete();

            $table->timestamps();
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
