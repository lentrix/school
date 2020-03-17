<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnrolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrols', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('student_id', 15);
            $table->integer('program_id')->unsigned();
            $table->integer('level_id')->unsigned();
            $table->integer('strand_id')->unsigned()->nullable();
            $table->integer('period_id')->unsigned();
            $table->string('type', 15);//old, new, transferee, shiftee
            $table->string('status', 15)->default('active'); //active, withdrawn
            $table->integer('section_id')->unsigned()->nullable();

            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('program_id')->references('id')->on('programs');
            $table->foreign('level_id')->references('id')->on('levels');
            $table->foreign('strand_id')->references('id')->on('strands');
            $table->foreign('period_id')->references('id')->on('periods');
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
        Schema::dropIfExists('enrols');
    }
}
