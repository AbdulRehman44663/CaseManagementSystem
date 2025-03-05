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
        Schema::create('client_appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_case_information_id');
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->unsignedBigInteger('type');
            $table->unsignedBigInteger('attorney_id');
            $table->unsignedBigInteger('appointment_location_id');
            $table->string('status');
            
            $table->foreign('type')->references('id')->on('appointment_color_legends')->onDelete('cascade'); // Foreign key constraint
            $table->foreign('client_case_information_id')->references('id')->on('client_case_information')->onDelete('cascade'); // Foreign key constraint
            $table->foreign('attorney_id')->references('id')->on('attorneys')->onDelete('cascade'); // Foreign key constraint
            $table->foreign('appointment_location_id')->references('id')->on('appointment_locations')->onDelete('cascade'); // Foreign key constraint
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_appointments');
    }
};
