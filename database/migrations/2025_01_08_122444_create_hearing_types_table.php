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
        Schema::create('hearing_types', function (Blueprint $table) {
            $table->id();
            // Case details
            $table->unsignedBigInteger('case_type_id'); 

            $table->string('name')->nullable();
            $table->string('color')->nullable();
            
            $table->foreign('case_type_id')->references('id')->on('case_types')->onDelete('cascade'); // Foreign key constraint
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hearing_types');
    }
};
