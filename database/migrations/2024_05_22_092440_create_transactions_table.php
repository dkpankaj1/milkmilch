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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id');
            $table->timestamp('date');
            $table->foreignId('customer_id')->nullable()->index();
            $table->decimal('amount',8,2)->default(0);
            $table->unsignedInteger('discount')->default(0);
            $table->string('discount_type')->default('fixed'); // [ fixed, percent ]
            $table->decimal('other_amt',8,2)->default(0);
            $table->decimal('grand_total',8,2)->default(0);
            $table->decimal('paid_amount',8,2)->default(0);
            $table->decimal('collect_amount',8,2)->default(0);
            $table->string('status'); //[ generated,processing,completed]
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
