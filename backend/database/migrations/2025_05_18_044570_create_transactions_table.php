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
        Schema::create('transactions', function (Blueprint $table) {
                $table->id();
                $table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade');
                $table->foreignId('hotel_id')->constrained('hotels')->onDelete('cascade');
                $table->foreignId('voucher_id')->nullable()->constrained('vouchers')->nullOnDelete();
                $table->tinyInteger('transaction_type');
                $table->char('transaction_code', 50);
                $table->integer('amount');
                $table->tinyInteger('payment_status');
                $table->dateTime('paid_at')->nullable();
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
        Schema::dropIfExists('transactions');
    }
};
