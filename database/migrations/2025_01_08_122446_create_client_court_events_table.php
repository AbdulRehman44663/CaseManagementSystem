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
        Schema::create('client_court_events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_case_information_id');
            $table->unsignedBigInteger('hearing_type_id');
            $table->unsignedBigInteger('attorney_id');
            $table->date('date');
            $table->time('time');
            $table->string('location');
          

            $table->foreign('hearing_type_id')->references('id')->on('hearing_types')->onDelete('cascade'); 
            $table->foreign('client_case_information_id')->references('id')->on('client_case_information')->onDelete('cascade'); // Foreign key constraint
            $table->foreign('attorney_id')->references('id')->on('attorneys')->onDelete('cascade'); // Foreign key constraint
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_court_events');
    }
};
