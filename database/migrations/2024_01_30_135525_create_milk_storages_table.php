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
        Schema::create('milk_storages', function (Blueprint $table) {
            $table->id();
            $table->timestamp('date');
            $table->unsignedBigInteger('milk_id');
            $table->decimal('ttl_volume',8,2);
            $table->decimal('avl_volume',8,2);
            $table->unsignedInteger('avg_shelf_life'); // days
            $table->string('status'); // STORAGE, TRANSFER
            $table->foreign('milk_id')->references('id')->on('milks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('milk_storages');
    }
};
