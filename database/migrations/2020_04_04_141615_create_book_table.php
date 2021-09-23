<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('book_id')->unique();
            $table->string('book_image')->default('user.png');
            $table->string('book_name');
            $table->bigInteger('book_category_id')->unsigned();
            $table->foreign('book_category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->bigInteger('book_author_id')->unsigned();
            $table->foreign('book_author_id')->references('id')->on('authors')->onDelete('cascade');
            $table->bigInteger('book_publisher_id')->unsigned();
            $table->foreign('book_publisher_id')->references('id')->on('publishers')->onDelete('cascade');
            $table->string('book_edition');
            $table->string('book_description');
            $table->bigInteger('book_price');
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
        Schema::dropIfExists('book');
    }
}
