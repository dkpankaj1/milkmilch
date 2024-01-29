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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('description');
            $table->decimal('mrp',8,2);
            $table->decimal('volume',8,2); // mililiter
            $table->unsignedInteger('shelf_life'); // days
            $table->binary('product_image')->nullable();
            $table->unsignedBigInteger('categorie_id');
            $table->tinyInteger('status');
            $table->timestamps();
            $table->foreign('categorie_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
