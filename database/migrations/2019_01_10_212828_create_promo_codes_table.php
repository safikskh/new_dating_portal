<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromoCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promo_codes', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('promoCode')->unique();
            $table->boolean('isFixed');
            $table->integer('discount')->unsigned();
            $table->date('edate')->nullable();
            $table->enum('duration',["once","forever","repeating"]);
            $table->integer('duration_in_months')->nullable();
            $table->boolean('isOneTimeUse')->default(0);
            $table->boolean('isUsed')->default(0);
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
        Schema::dropIfExists('promo_codes');
    }
}
