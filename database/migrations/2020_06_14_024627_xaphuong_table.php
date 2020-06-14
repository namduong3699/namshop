<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class XaphuongTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xaphuong', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('xaid')->unique();
            $table->string('name');
            $table->string('type');
            $table->unsignedInteger('maqh')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('xaphuong');
    }
}
