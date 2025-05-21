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
        Schema::create('booking_details', function (Blueprint $table) {
                $table->id();
                $table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade');
                $table->foreignId('room_type_id')->constrained('room_types')->onDelete('cascade');
                $table->foreignId('room_type_variant_id')->constrained('room_type_variants')->onDelete('cascade');
                $table->integer('quantity')->default(1);
                $table->integer('price_per_room')->default(0);
                $table->integer('total_price')->default(0);
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
        Schema::dropIfExists('booking_details');
    }
};
