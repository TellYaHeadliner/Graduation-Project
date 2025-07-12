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
            $table->id();
            $table->string('fullname')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('password')->nullable();
            $table->char('phone', 10)->nullable();
            $table->date('birthday')->nullable();
            $table->boolean('gender')->nullable();
            $table->text('address')->nullable();
            $table->text('avatar')->nullable();
            $table->string('provider')->nullable(); 
            $table->string('provider_id')->nullable()->unique(); 
            $table->timestamp('email_verified_at')->nullable();
            $table->tinyInteger('role')->default(1);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
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
