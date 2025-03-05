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
        Schema::create('client_intake_information', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('case_intake_field_id')->nullable();
            $table->unsignedBigInteger('client_case_information_id');
            $table->longText('answer')->nullable();
         
            $table->foreign('case_intake_field_id')->references('id')->on('case_intake_fields')->onDelete('cascade'); // Foreign key constraint
            $table->foreign('client_case_information_id')->references('id')->on('client_case_information')->onDelete('cascade'); // Foreign key constraint
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_intake_information');
    }
};
