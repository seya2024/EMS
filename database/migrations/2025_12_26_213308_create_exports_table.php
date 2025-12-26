<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
    public function up(): void
    {
        Schema::create('exports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->string('exporter')->nullable();
            $table->integer('total_rows')->nullable();
            $table->string('file_disk')->nullable();
            $table->string('file_name')->default(''); // remove `after()`
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('exports', function (Blueprint $table) {
            $table->dropColumn('file_name');
        });
    }
};
