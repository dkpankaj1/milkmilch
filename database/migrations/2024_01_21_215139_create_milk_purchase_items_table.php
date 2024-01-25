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
        Schema::create('milk_purchase_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('milk_purchase_id');
            $table->unsignedBigInteger('milk_id');
            $table->decimal('fat_content', 5, 2);
            $table->unsignedInteger('shelf_life'); // days
            $table->decimal('volume',8,2); // mililiter
            $table->decimal('mrp',8,2);
            $table->decimal('mop',8,2);
            $table->decimal('total_amt',8,2);
            $table->timestamps();

            $table->foreign('milk_purchase_id')->references('id')->on('milk_purchases');
            $table->foreign('milk_id')->references('id')->on('milks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('milk_purchase_items');
    }
};
