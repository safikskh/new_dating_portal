<?php

use App\Enums\Sex;
use App\Enums\Height;
use App\Enums\Weight;
use App\Enums\Smoking;
use App\Enums\Tattoos;
use App\Enums\BodyType;
use App\Enums\Children;
use App\Enums\EyeColor;
use App\Enums\Piercing;
use App\Enums\HairColor;
use App\Enums\Searching;
use App\Enums\CivilStatus;
use App\Enums\SexualOrientation;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoupleInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('couple_infos', function (Blueprint $table) {
            $table->increments('id')->unique(); 
            $table->integer('portalJoinUser_id')->unsigned()->index();
            $table->enum('sex',[Sex::getValue('Mand'),Sex::getValue('Kvinde')])->nullable();
            $table->string('firstName')->nullable();
            $table->string('lastName')->nullable();
            $table->date('dob')->nullable();
            $table->enum('sexualOrientation',[SexualOrientation::getValues()])->nullable();
            $table->enum('civilStatus',[CivilStatus::getValues()])->nullable();
            $table->enum('height',[Height::getValues()])->nullable();
            $table->enum('weight',[Weight::getValues()])->nullable();
            $table->enum('hairColor',[HairColor::getValues()])->nullable();
            $table->enum('eyeColor',[EyeColor::getValues()])->nullable();
            $table->text('searching',[Searching::getValues()])->nullable();
            $table->enum('bodyType',[BodyType::getValues()])->nullable();
            $table->enum('tattoos',[Tattoos::getValues()])->nullable();
            $table->enum('piercing',[Piercing::getValues()])->nullable();
            $table->enum('children',[Children::getValues()])->nullable();
            $table->enum('smoking',[Smoking::getValues()])->nullable();
            $table->string('profilePicture')->default('uploads/profilePictures/defaultPicture.png');
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
        Schema::dropIfExists('couple_infos');
    }
}
