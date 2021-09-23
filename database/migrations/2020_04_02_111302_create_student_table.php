<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('student_id')->unique();
            $table->string('student_name');
            $table->string('student_image')->default('user.png');
            $table->string('student_gender');
            $table->date('student_dob');
            $table->string('student_contact');
            $table->string('student_email');
            $table->bigInteger('student_college_id')->unsigned();
            $table->foreign('student_college_id')->references('id')->on('colleges')->onDelete('cascade');
            $table->bigInteger('student_department_id')->unsigned();
            $table->foreign('student_department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->bigInteger('student_batch_id')->unsigned();
            $table->foreign('student_batch_id')->references('id')->on('batches')->onDelete('cascade');
            $table->string('student_status')->default('2');
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
        Schema::dropIfExists('student');
    }
}
