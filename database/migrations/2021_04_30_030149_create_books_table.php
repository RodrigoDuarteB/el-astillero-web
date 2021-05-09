<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            // from isbndb API
            $table->string('title');
            $table->text('title_long')->nullable();
            $table->string('isbn')->unique();
            $table->string('isbn13')->unique();
            $table->string('dewey_decimal');
            $table->string('binding')->nullable();
            $table->string('publisher');
            $table->string('language');
            $table->dateTime('date_published');
            $table->string('edition')->nullable();
            $table->unsignedInteger('pages');
            $table->string('dimensions')->nullable();
            $table->text('overview')->nullable();
            $table->string('cover');
            $table->string('back')->nullable();
            $table->string('excerpt')->nullable();
            $table->text('synopsys');
            $table->string('author');
            $table->string('subject');
            //own
            $table->unsignedInteger('stock')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
