<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Supplier extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('phone');
            $table->string('mokam');
            $table->string('address');
            $table->string('totaldue')->nullable();
            $table->string('totalpaid')->nullable();
            $table->date('created_at')->nullable();
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
        Schema::drop('suppliers');
    }
}
