<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('catalog_id');
            $table->string('name');
            $table->unsignedInteger('count');
            $table->text('size');
            $table->text('color');
            $table->unsignedInteger('price');
            $table->unsignedInteger('discount');
            $table->text('folder');
            $table->text('image_link');
            $table->text('image_list');
            $table->longText('description');
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
        Schema::drop('products');
    }
}
