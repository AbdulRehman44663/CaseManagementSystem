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
        Schema::create('client_invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('client_case_information_id');
            $table->unsignedBigInteger('case_type_id');
            $table->string('invoice_type')->nullable();
            $table->string('attorney_fee')->nullable();
            $table->string('filing_fee')->nullable();
            $table->string('status')->nullable();
            $table->string('total_fee')->nullable();
            $table->string('total_paid')->nullable();
            $table->string('total_expenses')->nullable();
            $table->string('total_hours')->nullable();
            $table->string('amount_due')->nullable();
            $table->string('attorney_percentage')->nullable();
            $table->string('amount_to_client')->nullable();
            $table->string('is_uncollectible')->default('NO')->nullable();
            $table->text('uncollectible_reason')->nullable();
            $table->string('payment_method')->nullable();
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('client_case_information_id')->references('id')->on('client_case_information')->onDelete('cascade');
            $table->foreign('case_type_id')->references('id')->on('case_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_invoices');
    }
};
