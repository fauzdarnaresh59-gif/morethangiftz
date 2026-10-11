<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_reviews', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('time')->nullable();
            $table->string('avatar')->nullable();
            $table->string('stars')->default('★★★★★');
            $table->text('review_text');
            $table->string('platform')->default('Google');
            $table->string('platform_icon')->nullable();
            $table->string('link_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
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
        Schema::dropIfExists('home_reviews');
    }
}
