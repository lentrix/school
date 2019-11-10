<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnrolClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrol_classes', function (Blueprint $table) {
            $table->bigInteger('enrol_id')->unsigned();
            $table->bigInteger('class_id')->unsigned();
            $table->string('rating1',10)->nullable();
            $table->string('rating2',10)->nullable();
            $table->string('rating3',10)->nullable();
            $table->string('rating4',10)->nullable();
            $table->string('grade',10)->nullable();
            $table->timestamps();

            $table->foreign('enrol_id')->references('id')->on('enrols');
            $table->foreign('class_id')->references('id')->on('classes');

            $table->primary(['enrol_id','class_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enrol_classes');
    }
}
