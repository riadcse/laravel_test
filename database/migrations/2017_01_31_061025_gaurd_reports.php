<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GaurdReports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gaurd_reports', function (Blueprint $table){
            $table->increments('id');
            $table->integer('gaurd_id')->unsigned();
            $table->foreign('gaurd_id')->references('id')->on('gaurds');
            $table->string('salary');
            $table->string('minus');
            $table->string('totalsalary');
            $table->string('description')->nullable();
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
        Schema::drop('gaurd_reports');
    }
}
