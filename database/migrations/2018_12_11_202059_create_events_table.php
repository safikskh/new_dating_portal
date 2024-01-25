<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
           $table->increments('id')->unique();
            $table->integer('user_id')->unsigned()->index();
            $table->string('title');
            $table->string('type');
            $table->double('amount');
            $table->string('event_type');
            $table->date('event_date');
            $table->string('event_time');
            $table->text('location');
            $table->longText('details');
            $table->string('image');
            $table->integer('membership_id')->unsigned()->index();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });

//          Schema::table('events', function($table) {
//        $table->foreign('group_id')->references('id')->on('groups');
//    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
