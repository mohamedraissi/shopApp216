<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('section_id');
            $table->String('product_name');
            $table->String('product_code');
            $table->float('product_price');
            $table->float('product_discount');
            $table->String('main_image');
            $table->String('product_video');
            $table->String('product_description');
            $table->String('product_meta_description');
            $table->String('product_meta_keyword');
            $table->String('product_previewing');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('products');
    }
}
