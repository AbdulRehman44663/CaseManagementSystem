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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            //$table->unsignedBigInteger('client_id')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->string('is_administrator')->nullable();
            $table->string('user_type')->nullable();
            $table->string('hourly_rate')->nullable();
            $table->string('status')->default('inactive');
            //$table->boolean('is_verified')->default(false);
            $table->string('verification_token')->nullable();
            
            //$table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade'); // Foreign key constraint

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
