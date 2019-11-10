<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('lname');
            $table->string('fname');
            $table->string('mname');
            $table->string('address');
            $table->string('phone')->nullable();
            $table->string('field')->nullable();
            $table->boolean('active')->default(true);
            $table->string('password');
            $table->integer('dept_id')->unsigned();
            $table->foreign('dept_id')->references('id')->on('departments');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
