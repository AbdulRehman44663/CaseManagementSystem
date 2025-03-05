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
        Schema::create('law_firm_information', function (Blueprint $table) {
            $table->id();
            $table->text('company_name'); 
            $table->text('attorney_1')->nullable();
            $table->text('attorney_2')->nullable();
            $table->text('attorney_3')->nullable();
            $table->text('address')->nullable();
            $table->text('suite')->nullable();
            $table->text('city_state_zip')->nullable();
            $table->text('telephone_no')->nullable();
            $table->text('fax_no')->nullable();
            $table->text('email_address')->nullable();
            $table->text('email_signature')->nullable();
            $table->enum('show_email_signature',['0','1']);
            $table->text('logo_image')->nullable();
            $table->text('signature')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('law_firm_information');
    }
};
