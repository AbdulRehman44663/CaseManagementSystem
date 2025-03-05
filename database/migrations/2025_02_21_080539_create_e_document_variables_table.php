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
        Schema::create('e_document_variables', function (Blueprint $table) {
            $table->id();
            $table->string('variable_name');
            $table->string('variable_type')->nullable();
            $table->string('table_name');
            $table->string('table_field_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('e_document_variables');
    }
};
