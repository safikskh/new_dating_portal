<?php

use App\User;
use App\Models\Events;
use App\Models\Categories;
use Faker\Generator as Faker;

$factory->define(App\Models\EventJoinUser::class, function (Faker $faker) {
    return [
        'user_id' => function(){
            return User::all()->random();
        },
        'event_id' => function(){
            return Events::all()->random();
        }
    ];
});
