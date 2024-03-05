<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
             $table->increments('id')->unique();
            $table->integer('user_id')->unsigned()->index();
            $table->string('title');
            $table->integer('group_type');
            $table->string('type');
            $table->longText('details');
            $table->string('image');
            $table->integer('membership_id')->unsigned()->index();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('groups');
    }
}
