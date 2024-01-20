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
        Schema::create('milks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('fat_content', 5, 2);
            $table->unsignedInteger('shelf_life'); // days
            $table->decimal('volume',8,2); // mililiter
            $table->decimal('mrp',8,2);
            $table->decimal('mop',8,2);
            $table->tinyInteger('status');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('milks');
    }
};
