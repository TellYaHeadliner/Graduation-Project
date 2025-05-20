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
        Schema::create('review_category_scores', function (Blueprint $table) {
            $table->foreignId('review_id')->constrained('reviews')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('review_categories')->onDelete('cascade');
            $table->integer('score');
            $table->timestamps();
            $table->primary(['review_id', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('review_category_scores');
    }
};
