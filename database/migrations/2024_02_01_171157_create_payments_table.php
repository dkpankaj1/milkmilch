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
        Schema::create('payments', function (Blueprint $table) {
            
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->timestamp('date');
            $table->decimal('amount',8,2);
            $table->unsignedInteger('discount')->default(0);
            $table->string('discount_type')->default('fixed'); // [ fixed, percent ]
            $table->decimal('other_amt',8,2)->default(0);
            $table->decimal('grand_total',8,2)->default(0);
            $table->decimal('paid_amount',8,2)->default(0);
            $table->string('payment_status')->default('pending'); // [ pending, paid, partial ]
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
