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
        Schema::create('hotels', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->string('name');
            $table->text('address');
            $table->longText('description')->nullable();
            $table->tinyInteger('star_rating')->default(0);
            $table->char('phone',10);
            $table->string('email')->unique();
            $table->integer('mst');
            $table->char('bank_account_number',50);
            $table->string('bank_account_name');
            $table->string('bank_name');
            $table->text('avatar')->nullable();
            $table->longText('gallery')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('reputation_score')->default(70);
            $table->timestamps();

            $table->foreign('id')->references('id')->on('users')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotels');
    }
};
