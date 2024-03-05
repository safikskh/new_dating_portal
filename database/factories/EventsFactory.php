<?php

use App\User;
use App\Models\Events;
use App\Models\Groups;
use App\Models\Categories;
use Faker\Generator as Faker;

$factory->define(App\Models\Events::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'sub_title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'details' => $faker->paragraph,
        'street' => $faker->streetName,
        'zip_code' => $faker->postcode,
        'city' => $faker->city,
        'is_public' => $faker->boolean,
        'image' => $faker->image('public/uploads/event', 900, 400, 'cats', true),
        'user_id' => function(){
            return User::all()->random();
        },
        'category_id' => function(){
            return Categories::all()->random();
        },
        'group_id' => function(){
            return Groups::all()->random();
        }
    ];
});
