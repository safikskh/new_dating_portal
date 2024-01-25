<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserLikesOnGroupPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_likes_on_group_posts', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('user_id')->unsigned()->index();
            $table->integer('group_id')->unsigned()->index();
            $table->integer('post_id')->unsigned()->index();
            $table->integer('is_like');
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
        Schema::dropIfExists('user_likes_on_group_posts');
    }
}
