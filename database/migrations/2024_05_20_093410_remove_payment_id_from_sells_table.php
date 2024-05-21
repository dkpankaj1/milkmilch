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
        Schema::table('sells', function (Blueprint $table) {
            // Remove the foreign key constraint first
            $table->dropForeign(['payment_id']);
            
            // Then drop the column
            $table->dropColumn('payment_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sells', function (Blueprint $table) {
            // Add the column back
            $table->unsignedBigInteger('payment_id')->nullable();

            // Add the foreign key constraint back
            $table->foreign('payment_id')->references('id')->on('payments');
        });
    }
};
