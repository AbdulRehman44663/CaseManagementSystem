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
        Schema::create('client_emails', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_case_information_id');
            $table->string('subject');
            $table->string('from');
            $table->string('to');
            $table->longText('body')->nullable();
            $table->timestamp('last_time_re_sent')->nullable();
            $table->integer('time_resent')->nullable();
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
        Schema::dropIfExists('client_emails');
    }
};
