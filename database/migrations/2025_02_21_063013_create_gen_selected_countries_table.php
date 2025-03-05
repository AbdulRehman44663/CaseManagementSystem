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
        Schema::create('gen_selected_countries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('general_selected_state_id');
            $table->unsignedBigInteger('genaral_court_country_other_id');

            $table->foreign('general_selected_state_id')->references('id')->on('general_selected_states')->onDelete('cascade'); // Foreign key constraint
            $table->foreign('genaral_court_country_other_id')->references('id')->on('genaral_court_country_others')->onDelete('cascade'); // Foreign key constraint
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gen_selected_countries');
    }
};
