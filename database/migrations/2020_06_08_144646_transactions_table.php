<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('user_name');
            $table->string('user_email');
            $table->string('user_phone');
            $table->unsignedInteger('amount');
            $table->string('payment');
            $table->text('payment_info');
            $table->text('message');
            $table->text('security');
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
        Shema::drop('transactions');
    }
}
