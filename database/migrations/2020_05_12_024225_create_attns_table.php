<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('classes_id')->unsigned();
            $table->string('remarks')->nullable();
            $table->timestamps();
            $table->foreign('classes_id')->references('id')->on('classes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attns');
    }
}
