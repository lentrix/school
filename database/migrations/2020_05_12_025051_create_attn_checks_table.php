<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttnChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attn_checks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('attn_id')->unsigned();
            $table->bigInteger('enrol_id')->unsigned();
            $table->bigInteger('class_id')->unsigned();
            $table->string('att',2)->default('pr'); //Present (pr), Absent(ab), Late(lt), Excused(ex)
            $table->timestamps();
            $table->foreign('attn_id')->references('id')->on('attns');
            $table->foreign('enrol_id')->references('enrol_id')->on('enrol_classes');
            $table->foreign('class_id')->references('class_id')->on('enrol_classes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attn_checks');
    }
}
