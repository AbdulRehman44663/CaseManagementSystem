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
        Schema::create('tasks', function (Blueprint $table) {
                $table->id();
                $table->string('client_name')->nullable();
                $table->unsignedBigInteger('client_id'); 
                $table->unsignedBigInteger('client_case_information_id')->nullable(); 

                $table->text('details')->nullable();
                $table->date('date');
                $table->time('time');
                $table->boolean('completed')->default(false); // Global task status
                $table->foreignId('assigned_by')->constrained('users')->nullable();
                $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade'); // Foreign key constraint
                $table->foreign('client_case_information_id')->references('id')->on('client_case_information')->onDelete('cascade'); // Foreign key constraint

                $table->timestamps();            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
