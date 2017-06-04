<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Gaurds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gaurds', function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('designation');
            $table->date('dateofbirth');
            $table->string('bloodgroup');
            $table->string('phone');
            $table->string('address');
            $table->string('totaldue')->nullable();
            $table->string('totalpaid')->nullable();
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
        Schema::drop('gaurds');
    }
}
