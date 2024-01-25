<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('milk_purchase_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('milk_purchase_id');
            $table->unsignedBigInteger('payment_mode_id');
            $table->decimal('amt', 8, 2);
            $table->timestamps();
            $table->foreign('milk_purchase_id')->references('id')->on('milk_purchases');
            $table->foreign('payment_mode_id')->references('id')->on('payment_modes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('milk_purchase_payments');
    }
};
