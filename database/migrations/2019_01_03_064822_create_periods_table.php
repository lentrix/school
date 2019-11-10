<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeriodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('accronym', 30);
            $table->string('name');
            $table->date('start');
            $table->date('end');
            $table->string('type',15)->default('semestral');//annual, semestral, trimestral
            $table->string('status')->default('pending'); //pending, enrolment, prelim, midterm, semi-final, final, expired
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
        Schema::dropIfExists('periods');
    }
}
