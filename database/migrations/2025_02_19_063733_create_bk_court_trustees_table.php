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
        Schema::create('bk_court_trustees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bk_court_state_id');
            $table->unsignedBigInteger('bk_court_district_id');
            $table->string('bk_trustee_name');
            $table->string('bk_trustee_address')->nullable();
            $table->string('bk_trustee_city_zip')->nullable();
            $table->string('bk_trustee_tel')->nullable();
            $table->string('bk_trustee_fax')->nullable();
            $table->string('bk_trustee_email')->nullable();
            $table->string('bk_trustee_website')->nullable();

            $table->foreign('bk_court_state_id')->references('id')->on('bk_court_states')->onDelete('cascade'); // Foreign key constraint
            $table->foreign('bk_court_district_id')->references('id')->on('bk_court_districts')->onDelete('cascade'); // Foreign key constraint
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bk_court_trustees');
    }
};
