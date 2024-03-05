<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('from_user_id')->unsigned()->index()->nullable();
            $table->integer('to_user_id')->unsigned()->index()->nullable();
            $table->integer('portal_id')->nullable(false);
            $table->integer('rating_value')->default(0)->nullable();
            $table->boolean('rating_status')->default(0)->nullable();
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
        Schema::dropIfExists('ratings');
    }
}
