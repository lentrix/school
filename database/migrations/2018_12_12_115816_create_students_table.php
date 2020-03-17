<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->string('id', 15);
            $table->string('lrn',25)->unique();
            $table->string('lname');
            $table->string('fname');
            $table->string('mname');
            $table->date('bdate');
            $table->string('gender', 6);
            $table->string('barangay');
            $table->string('town');
            $table->string('province');
            $table->string('phone')->nullable();
            $table->string('religion',60)->nullable();
            $table->string('citizenship')->nullable();
            $table->string('mother')->nullable(); //mother's name
            $table->string('mphone')->nullable(); //mother's phone
            $table->string('father')->nullable(); //father's name
            $table->string('fphone')->nullable(); //father's phone
            $table->string('pr_address')->nullable(); //parent's address
            $table->timestamps();

            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
