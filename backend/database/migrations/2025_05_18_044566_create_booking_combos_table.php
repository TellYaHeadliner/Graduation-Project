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
        Schema::create('booking_combos', function (Blueprint $table) {
            $table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade');
            $table->foreignId('combo_id')->constrained('combos')->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->integer('price')->default(0);
            $table->integer('total_price')->default(0);
            $table->primary(['booking_id', 'combo_id']);
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
        Schema::dropIfExists('booking_combos');
    }
};
