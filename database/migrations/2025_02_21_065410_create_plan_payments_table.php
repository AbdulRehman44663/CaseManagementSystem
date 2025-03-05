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
        Schema::create('plan_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_invoice_id');
            $table->string('payment_number');
            $table->date('payment_date');
            $table->string('payment_amount');
            $table->string('is_paid')->default("NO");
            $table->string('payment_method');
            $table->string('payment_recieved_by')->nullable();
            $table->string('payment_card_number')->nullable();
            $table->string('lawpay_refund_id')->nullable();
            $table->string('lawpay_invoice_id')->nullable();
            $table->string('payment_registered')->nullable();
            $table->text('extra_notes')->nullable();
            $table->timestamps();


            $table->foreign('client_invoice_id')->references('id')->on('client_invoices')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_payments');
    }
};
