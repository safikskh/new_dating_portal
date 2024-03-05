<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(App\Models\Blogs::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'sub_title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'details' => $faker->paragraph,
        'image' => $faker->image('public/uploads/blog', 900, 400, 'cats', true),
        'user_id' => function(){
            return User::all()->random();
        }
    ];
});
