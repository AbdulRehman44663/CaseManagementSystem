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
        Schema::table('case_intake_fields', function (Blueprint $table) {
            $table->integer('order_number')->default(0)->after('required'); // Adjust position if necessary
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('case_intake_fields', function (Blueprint $table) {
            $table->dropColumn('order_number');
        });
    }
};
