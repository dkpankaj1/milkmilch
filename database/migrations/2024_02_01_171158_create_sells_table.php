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
        Schema::create('sells', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->date('date');
            $table->decimal('other_amt',8,2)->default(0);
            $table->unsignedInteger('discount')->default(0);
            $table->string('discount_type'); // [ fixed, percent ]
            $table->string('order_status'); // [ orderd, pending, complete, reject ]
            $table->string('payment_status'); // [ pending, paid, partial ]
            $table->decimal('grand_total',8,2);
            $table->decimal('paid_amt',8,2)->default(0);
            $table->text('note');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('payment_id')->references('id')->on('payments');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sells');
    }
};
