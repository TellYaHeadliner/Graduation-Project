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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained('hotels')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade');
            $table->string('title');
            $table->longText('description');
            $table->longText('gallery')->nullable();
            $table->longText('hotel_reply')->nullable();
            $table->longText('hotel_reply_gallery')->nullable();
            $table->boolean('hotel_agree_refund')->default(false);
            $table->dateTime('hotel_reply_time')->nullable();
            $table->integer('admin_refund_amount')->nullable();
            $table->longText('admin_reason')->nullable();
            $table->dateTime('admin_verified_at')->nullable();
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('complaints');
    }
};
