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
        Schema::create('bk_court_selected_districts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bk_court_selected_state_id');
            $table->unsignedBigInteger('bk_court_district_id');
            $table->foreign('bk_court_selected_state_id')->references('id')->on('bk_court_selected_states')->onDelete('cascade'); // Foreign key constraint
            $table->foreign('bk_court_district_id')->references('id')->on('bk_court_districts')->onDelete('cascade'); // Foreign key constraint
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bk_court_selected_districts');
    }
};
