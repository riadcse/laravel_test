<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Workers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workers', function (Blueprint $table){
            $table->increments('id');
            $table->string('cardnumber')->unique();;
            $table->string('name');
            $table->string('designation');
            $table->date('dateofbirth');
            $table->string('bloodgroup');
            $table->string('phone');
            $table->text('address');
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
        Schema::drop('workers');
    }
}
