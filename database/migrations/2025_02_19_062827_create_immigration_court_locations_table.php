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
        Schema::create('immigration_court_locations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('immigration_court_state_id');
            $table->string('immigration_court_address');
            $table->string('immigration_court_city_state_zip');
            $table->string('immigration_court_phone');
            $table->foreign('immigration_court_state_id')->references('id')->on('immigration_court_states')->onDelete('cascade'); // Foreign key constraint
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('immigration_court_locations');
    }
};
