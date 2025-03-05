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
        Schema::create('opposing_partyinfos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_case_information_id');
            $table->string('opposing_party_name')->nullable();
            $table->string('opposing_party_address')->nullable();
            $table->string('opposing_party_phone_number')->nullable();
            $table->string('attorney_name')->nullable();
            $table->string('attorney_firm')->nullable();
            $table->string('attorney_phone_number')->nullable();
            $table->string('attorney_fax')->nullable();
            $table->string('attorney_email')->nullable();

            $table->foreign('client_case_information_id')->references('id')->on('client_case_information')->onDelete('cascade'); // Foreign key constraint
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opposing_partyinfos');
    }
};
