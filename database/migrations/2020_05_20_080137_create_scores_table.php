<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('column_id')->unsigned();
            $table->bigInteger('enrol_id')->unsigned();
            $table->integer('score')->unsigned()->nullable();
            $table->foreign('column_id')->references('id')->on('columns')->onDelete('cascade');
            $table->foreign('enrol_id')->references('enrol_id')->on('enrol_classes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scores');
    }
}
