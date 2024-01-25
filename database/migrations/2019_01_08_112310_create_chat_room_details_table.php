<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatRoomDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_room_details', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('chatroom_name');
            $table->string('chatroom_image');
            $table->integer('portal_id')->nullable()->unsigned();
            $table->integer('membership_id')->unsigned()->index();
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
        Schema::dropIfExists('chat_room_details');
    }
}
