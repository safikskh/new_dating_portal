<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Enums\Sex;
use App\Enums\CivilStatus;
use App\Enums\SexualOrientation;
use App\Enums\Height;
use App\Enums\Weight;
use App\Enums\BodyType;
use App\Enums\Children;
use App\Enums\EyeColor;
use App\Enums\HairColor;

class CreateUserTempsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_temps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('email');
            $table->string('password');
            $table->date('dob')->nullable();
            $table->enum('sex',[Sex::getValues()])->nullable();
            $table->string('seek')->nullable();
            $table->string('seekg')->nullable();
            $table->string('iAmSeekingA')->nullable();
            $table->integer('country')->nullable()->unsigned();
            $table->string('zipCode')->nullable();
            $table->enum('civilStatus',[CivilStatus::getValues()])->nullable();
            $table->enum('sexualOrientation',[SexualOrientation::getValues()])->nullable();
            $table->enum('height',[Height::getValues()])->nullable();
            $table->enum('weight',[Weight::getValues()])->nullable();
            $table->enum('hairColor',[HairColor::getValues()])->nullable();
            $table->enum('eyeColor',[EyeColor::getValues()])->nullable();
            $table->enum('bodyType',[BodyType::getValues()])->nullable();
            $table->enum('children',[Children::getValues()])->nullable();
            $table->text('matchWords')->nullable();
            $table->text('nMatchWords')->nullable();
            $table->string('profilePicture')->default('uploads/profilePictures/defaultPicture.png');
            $table->longText('profile_detail')->nullable();
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
        Schema::dropIfExists('user_temps');
    }
}
