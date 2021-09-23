<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('accession_id')->unsigned();
            $table->foreign('accession_id')->references('id')->on('accessions')->onDelete('cascade');
            $table->bigInteger('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->date('from_date');
            $table->date('to_date');
            $table->dateTime('last_mail_date');
            $table->string('no_of_reminder')->default('0');
            $table->dateTime('actual_return_date')->nullable();
            $table->string('issued_by');
            $table->string('taken_by')->nullable();
            $table->string('status')->default('3');
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
        Schema::dropIfExists('transaction');
    }
}
