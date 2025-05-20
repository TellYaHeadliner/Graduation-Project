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
        Schema::create('room_type_season_prices', function (Blueprint $table) {
            $table->foreignId('room_type_variant_id')->constrained('room_type_variants')->onDelete('cascade');
            $table->foreignId('season_id')->constrained('seasons')->onDelete('cascade');
            $table->tinyInteger('discount_type')->default(0); // 0: %, 1: fixed amount
            $table->integer('discount_value')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->primary(['room_type_variant_id', 'season_id']);
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
        Schema::dropIfExists('room_type_season_prices');
    }
};
