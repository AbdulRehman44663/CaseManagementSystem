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
        Schema::create('client_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('user_assigned')->nullable();
            $table->unsignedBigInteger('client_case_information_id');
            $table->text('details');
            $table->date('date');
            $table->time('time');
            $table->string('status');
            $table->softDeletes();
            
            $table->foreign('client_case_information_id')->references('id')->on('client_case_information')->onDelete('cascade'); // Foreign key constraint
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_tasks');
    }
};
