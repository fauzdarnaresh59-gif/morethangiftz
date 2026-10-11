<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeSectionProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_section_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('home_product_section_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('code')->nullable();
            $table->string('image_path');
            $table->string('alt_text')->nullable();
            $table->string('price');
            $table->string('whatsapp_message')->nullable();
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
        Schema::dropIfExists('home_section_products');
    }
}
