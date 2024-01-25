<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPostOnGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_post_on_groups', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('user_id')->unsigned()->index();
            $table->integer('group_id')->unsigned()->index();
            $table->string('data');
            $table->string('type');
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
        Schema::dropIfExists('user_post_on_groups');
    }
}
