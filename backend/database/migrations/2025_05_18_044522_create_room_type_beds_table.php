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
        Schema::create('room_type_beds', function (Blueprint $table) {
            $table->foreignId('room_type_id')->constrained('room_types')->onDelete('cascade');
            $table->foreignId('bed_type_id')->constrained('bed_types')->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->primary(['room_type_id', 'bed_type_id']);
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
        Schema::dropIfExists('room_type_beds');
    }
};
