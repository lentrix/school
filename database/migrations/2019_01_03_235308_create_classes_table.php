<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('course_id')->unsigned();
            $table->integer('period_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('section_id')->unsigned()->nullable();
            $table->integer('program_id')->unsigned()->nullable();
            $table->integer('department_id')->unsigned()->nullable();
            $table->float('credit_units');
            $table->float('pay_units');

            $table->foreign('course_id')->references('id')->on('courses');
            $table->foreign('period_id')->references('id')->on('periods');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('section_id')->references('id')->on('sections');
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
        Schema::dropIfExists('classes');
    }
}
