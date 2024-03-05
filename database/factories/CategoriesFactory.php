<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Categories::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
       
    ];
});
