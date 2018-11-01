<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Note::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'content' => $faker->text,
        'user_id' => \App\Models\User::all()->random()->id
    ];
});
