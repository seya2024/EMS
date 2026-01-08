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
        Schema::table('asset_maintenances', function (Blueprint $table) {

            $table->enum('approval_status', ['PENDING', 'ACCEPTED', 'REJECTED'])
                ->default('PENDING')
                ->after('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {


        Schema::table('asset_maintenances', function (Blueprint $table) {
            $table->dropColumn('approval_status');
        });
        //

    }
};
