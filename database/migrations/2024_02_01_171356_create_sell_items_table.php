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
        Schema::create('sell_items', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('sell_id');
            $table->unsignedBigInteger('stock_id');
            $table->unsignedInteger('quentity');
            $table->unsignedInteger('mrp');
            $table->decimal('total_amt',8,2);
            $table->timestamps();

            $table->foreign('sell_id')->references('id')->on('sells');
            $table->foreign('stock_id')->references('id')->on('stocks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sell_items');
    }
};
