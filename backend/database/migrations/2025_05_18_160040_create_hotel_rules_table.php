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
        Schema::create('hotel_rules', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->time('check_in_time');
            $table->time('check_out_time');
            $table->boolean('pet_policy')->default(false);
            $table->boolean('child_policy')->default(false);
            $table->integer('free_child_age')->nullable();
            $table->integer('extra_bed_fee')->nullable();
            $table->timestamps();
            
            $table->foreign('id')->references('id')->on('hotels')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotel_rules');
    }
};
