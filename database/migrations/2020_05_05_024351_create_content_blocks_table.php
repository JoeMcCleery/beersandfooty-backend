<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_blocks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('review_id')->unsigned()->nullable();
            $table->foreign('review_id')->references('id')->on('reviews')->onDelete('cascade');
            $table->integer('sort')->default(0)->unsigned();
            $table->enum('type', ['long_text', 'short_text', 'score', 'image']);
            $table->string('content', 1024);
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
        Schema::dropIfExists('content_blocks');
    }
}
