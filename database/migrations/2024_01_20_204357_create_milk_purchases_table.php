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
        Schema::create('milk_purchases', function (Blueprint $table) {
            $table->id()->from(1000);
            $table->timestamp('purchase_date');
            $table->unsignedBigInteger('supplier_id');
            $table->decimal('other_amt',8,2)->default(0);
            $table->decimal('grand_total',8,2);
            $table->unsignedInteger('discount')->default(0);
            $table->string('discount_type'); // [ fixed, percent ]
            $table->string('order_status'); // [ orderd, pending, complete, reject ]
            $table->string('payment_status'); // [ pending, paid, partial ]
            $table->decimal('paid_amt',8,2)->default(0);
            $table->text('note');
            $table->timestamps();

            $table->foreign('supplier_id')->references('id')->on('suppliers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('milk_purchases');
    }
};
