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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('postal_code');
            $table->string('country');
            $table->string('gst_number')->nullable();
            $table->string('pan_number')->nullable();
            $table->string('upi')->nullable();
            $table->binary('upi_barcode')->nullable();
            $table->string('website')->nullable();
            $table->binary('logo')->nullable();
            $table->binary('fevicon')->nullable();
            $table->unsignedBigInteger('currencies_id')->nullable();

            $table->timestamps();

            $table->foreign('currencies_id')->references('id')->on('currencies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
