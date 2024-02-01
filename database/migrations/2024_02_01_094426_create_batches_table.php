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
        Schema::create('batches', function (Blueprint $table) {
            $table->id();
            $table->string("batch_code")->unique();
            $table->timestamp('date');
            $table->unsignedBigInteger('milk_storage_id');
            $table->decimal('volume',8,2);
            $table->timestamps();

            $table->foreign('milk_storage_id')->references('id')->on('milk_storages');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batches');
    }
};
