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
        Schema::create('case_intake_fields', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->text('description')->nullable();
            $table->string('field_type');
            $table->text('possible_options')->nullable();
            $table->boolean('visible')->default(true);
            $table->boolean('required')->default(false);
            $table->string('placeholder')->nullable();
            $table->unsignedBigInteger('case_type');
            $table->foreign('case_type')->references('id')->on('case_types')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('case_intake_fields');
    }
};
