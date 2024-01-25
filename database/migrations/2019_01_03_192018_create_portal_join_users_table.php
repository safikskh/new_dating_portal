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

class CreatePortalJoinUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portal_join_users', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('username')->unique()->nullable();
            $table->integer('user_id')->unsigned()->index();
            $table->integer('portal_id')->unsigned()->index();
            $table->integer('membership_id')->unsigned()->index();
            $table->timestamp('membership_ends_at')->nullable();
            $table->string('firstName');
            $table->string('lastName');
            $table->date('dob')->nullable();
            $table->enum('sexualOrientation',[SexualOrientation::getValues()])->nullable();
            $table->enum('sex',[Sex::getValues()])->nullable();
            $table->string('zipCode')->nullable();
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
            $table->text('matchWords')->nullable();
            $table->text('nMatchWords')->nullable();
            $table->integer('region_id')->nullable()->unsigned();
            $table->string('profilePicture')->default('uploads/profilePictures/defaultPicture.png');
            $table->longText('profile_detail')->nullable();
            $table->string('status_title')->nullable();
            $table->string('status_detail')->nullable();
            $table->timestamp('status_ends_at')->nullable();
            $table->boolean('isvisible')->default(1);
            $table->boolean('isDeactivate')->default(0);
            $table->boolean('isDisablePushNotif')->default(0);
            $table->boolean('isDisableEmailNotif')->default(0);
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
        Schema::dropIfExists('portal_join_users');
    }
}
