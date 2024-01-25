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
use App\Enums\IAmSeekingA;
use App\Enums\SexualOrientation;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unique();            
            $table->string('email')->unique();            
            $table->integer('portalJoinUser_id')->nullable()->unsigned();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('stripe_id')->nullable()->collation('utf8mb4_bin');
            $table->string('card_brand')->nullable();
            $table->string('card_last_four', 4)->nullable();
            $table->timestamp('trial_ends_at')->nullable();
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
        Schema::dropIfExists('users');
    }
}
