<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id()->from(1000);
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->default(fake()->phoneNumber());
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->default('india');
            $table->string('avatar')->default(env('DEFAULT_AVATAR','img/avatar.png'));
            $table->unsignedBigInteger('role_id')->default(5);
            $table->tinyInteger("status")->default(0);
            $table->timestamps();

            $table->foreign("role_id")->references("id")->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};