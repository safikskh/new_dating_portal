<?php

use App\Models\Groups;
use App\Models\Categories;
use Faker\Generator as Faker;

$factory->define(App\Models\Groups::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'details' => $faker->paragraph,
        'is_public' => $faker->boolean,
        'image' => $faker->image('public/uploads/group', 900, 400, 'cats', true),
        'category_id' => function(){
            return Categories::all()->random();
        }
    ];
});
