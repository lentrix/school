<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 60);
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('period_id')->unsigned();
            $table->integer('program_id')->unsigned();
            $table->integer('level_id')->unsigned();
            $table->integer('room_id')->unsigned()->nullable();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('period_id')->references('id')->on('periods');
            $table->foreign('program_id')->references('id')->on('programs');
            $table->foreign('level_id')->references('id')->on('levels');
            $table->foreign('room_id')->references('id')->on('rooms');

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
        Schema::dropIfExists('sections');
    }
}
