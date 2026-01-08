<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1️⃣ Create the main user_groups table
        Schema::create('user_groups', function (Blueprint $table) {
            $table->id(); // BIGINT UNSIGNED
            $table->string('name')->unique()->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // // 2️⃣ Optional: pivot table for many-to-many users <-> user_groups
        // Schema::create('user_user_group', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('user_id')
        //         ->constrained('users') // users table must exist
        //         ->cascadeOnDelete();
        //     $table->foreignId('user_group_id')
        //         ->constrained('user_groups')
        //         ->cascadeOnDelete();
        //     $table->timestamps();

        //     // prevent duplicate entries
        //     $table->unique(['user_id', 'user_group_id']);
        // });
    }

    public function down(): void
    {
        // Drop pivot first, then main table
        Schema::dropIfExists('user_user_group');
        Schema::dropIfExists('user_groups');
    }
};
