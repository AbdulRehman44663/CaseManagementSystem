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
        Schema::table('attorneys', function (Blueprint $table) {

              // Drop the existing columns
            $table->dropColumn(['state', 'zip_code']);
            
            // Add the new column
            $table->string('city_state_zip')->nullable()->after('phone_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attorneys', function (Blueprint $table) {
            //
        });
    }
};
