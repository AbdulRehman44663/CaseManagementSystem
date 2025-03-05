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
        Schema::create('client_case_information', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->integer('parent_id')->nullable();

             // Case details
             $table->unsignedBigInteger('case_type_id'); 
             $table->unsignedBigInteger('lead_source_id')->nullable(); 
             $table->unsignedBigInteger('a_d_placement_id')->nullable(); 
             $table->string('city')->nullable();
             $table->text('case_notes')->nullable();
            
            $table->unsignedBigInteger('case_analyst')->nullable(); 
            $table->unsignedBigInteger('attorney_assigned')->nullable();
            $table->string('case_number')->nullable();
            $table->string('case_title')->nullable();
            $table->date('case_filed')->nullable();
            $table->date('complaint_filed')->nullable();
            $table->date('complaint_served')->nullable();

            $table->string('court_address')->nullable();
            $table->string('department')->nullable();
            $table->string('judge')->nullable();
            $table->date('answer_filed')->nullable();
            $table->date('answer_served')->nullable();

            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade'); // Foreign key constraint
            $table->foreign('case_type_id')->references('id')->on('case_types')->onDelete('cascade'); // Foreign key constraint
            $table->foreign('lead_source_id')->references('id')->on('lead_sources')->onDelete('cascade'); // Foreign key constraint
            $table->foreign('a_d_placement_id')->references('id')->on('a_d_placements')->onDelete('cascade'); // Foreign key constraint

            $table->foreign('case_analyst')->references('id')->on('users')->onDelete('cascade'); // Foreign key constraint
            $table->foreign('attorney_assigned')->references('id')->on('attorneys')->onDelete('cascade'); // Foreign key constraint
            //$table->foreign('court_address')->references('id')->on('courts')->onDelete('cascade'); // Foreign key constraint

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_case_information');
    }
};
