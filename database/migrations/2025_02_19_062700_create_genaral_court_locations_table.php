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
        Schema::create('genaral_court_locations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('genaral_court_state_id');
            $table->unsignedBigInteger('genaral_court_country_other_id');
            $table->string('general_court_address');
            $table->string('general_court_city_zip')->nullable();
            $table->string('general_court_phone')->nullable();
            $table->foreign('genaral_court_state_id')->references('id')->on('genaral_court_states')->onDelete('cascade'); // Foreign key constraint
            $table->foreign('genaral_court_country_other_id')->references('id')->on('genaral_court_country_others')->onDelete('cascade'); // Foreign key constraint
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('genaral_court_locations');
    }
};
