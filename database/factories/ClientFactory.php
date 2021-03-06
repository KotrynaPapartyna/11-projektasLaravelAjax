<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Client;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
    return [
        "name"=>$faker->firstName(),
        "surname"=>$faker->lastName(),
        "description"=>$faker->paragraph(3)
    ];
});
