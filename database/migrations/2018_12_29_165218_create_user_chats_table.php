<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_chats', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('sender_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->text('detail')->nullable();
            $table->string('file')->nullable();
            $table->boolean('status')->default(true);
            $table->boolean('isPromoted')->default(false);
            $table->integer('portal_id')->unsigned();
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
        Schema::dropIfExists('user_chats');
    }
}
