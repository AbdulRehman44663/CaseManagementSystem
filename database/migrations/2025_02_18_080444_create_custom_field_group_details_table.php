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
        Schema::create('custom_field_group_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('custom_field_group_id');
            $table->string('label');
            $table->text('description')->nullable();
            $table->string('field_type');
            $table->text('possible_options')->nullable();
            $table->boolean('visible')->default(true);
            $table->boolean('required')->default(false);
            $table->string('placeholder')->nullable();
            $table->integer('order_number')->default(0);
            $table->foreign('custom_field_group_id')->references('id')->on('custom_field_groups')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_field_group_details');
    }
};
