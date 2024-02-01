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
        Schema::create('stocks', function (Blueprint $table) {
            
            $table->id();
            
            $table->unsignedBigInteger('batch_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedInteger('shelf_life'); // days
            $table->decimal('volume',8,2); // mililiter
            $table->decimal('mrp',8,2);
            $table->unsignedInteger('quentity');
            $table->unsignedInteger('available');
            $table->timestamp('best_befour');
            $table->timestamps();

            $table->foreign('batch_id')->references('id')->on('batches');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
