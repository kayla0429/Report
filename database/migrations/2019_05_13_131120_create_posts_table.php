<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    //포스트 테이블
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('pid');
            $table->integer('id');
            $table->string('title');
            $table->string('content');
            $table->string('image');
            $table->integer('likes');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
