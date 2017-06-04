<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GaurdsPayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gaurds_payment', function(Blueprint $table){
            $table->increments('id');
            $table->integer('gaurd_id')->unsigned();
            $table->foreign('gaurd_id')->references('id')->on('gaurds');
            $table->string('amount');
            $table->string('due')->nullable();
            $table->date('created_at');
            $table->date('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('gaurds_payment');
    }
}
