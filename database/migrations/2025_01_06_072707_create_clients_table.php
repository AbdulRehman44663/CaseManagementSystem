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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            // Primary client details
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('primary_client_name')->nullable();
            $table->string('property_address')->nullable();
            $table->string('telephone_number')->nullable();
            $table->string('alt_phone')->nullable();
            $table->string('email_address')->nullable();
            $table->string('drivers_license_no')->nullable();
            $table->string('ssn')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('marital_status')->nullable();
            $table->text('other_notes')->nullable();

            // Secondary client details
            $table->string('secondary_client_name')->nullable();
            $table->string('secondary_telephone_number')->nullable();
            $table->string('secondary_email_address')->nullable();
            $table->string('secondary_drivers_license_no')->nullable();
            $table->string('secondary_ssn')->nullable();
            $table->date('secondary_date_of_birth')->nullable();
            
           
            
            $table->unsignedBigInteger('entered_by'); 
            
            $table->unsignedBigInteger('lead_status_id');
            $table->unsignedBigInteger('client_status_id');
            $table->string('type');
            $table->unsignedBigInteger('lead_assigned_to')->nullable();
            // invoice type field remining
            $table->string('attorney_percentage')->nullable();
            $table->longText('lead_notes')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Foreign key constraint
            $table->foreign('entered_by')->references('id')->on('users')->onDelete('cascade'); // Foreign key constraint

            $table->foreign('client_status_id')->references('id')->on('client_statuses')->onDelete('cascade'); // Foreign key constraint
            $table->foreign('lead_status_id')->references('id')->on('lead_statuses')->onDelete('cascade'); // Foreign key constraint
            $table->foreign('lead_assigned_to')->references('id')->on('users')->onDelete('cascade'); // Foreign key constraint
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
