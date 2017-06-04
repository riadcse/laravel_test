<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WorkerReport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worker_report', function (Blueprint $table){
            $table->increments('id');
            $table->integer('worker_id')->unsigned();
            $table->foreign('worker_id')->references('id')->on('workers');
            $table->string('shift');
            $table->string('d1');
            $table->string('d2');
            $table->string('d3');
            $table->string('d4');
            $table->string('d5');
            $table->string('d6');
            $table->string('d7');
            $table->string('totalhour');
            $table->string('wages');
            $table->string('bonus');
            $table->string('night');
            $table->string('friday');
            $table->string('totalwages');
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
        Schema::drop('worker_report');
    }
}
