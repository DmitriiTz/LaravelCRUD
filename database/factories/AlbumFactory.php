<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Album;
use App\Artist;
use Faker\Generator as Faker;

$factory->define(Album::class, function (Faker $faker) {


    $artistIds = Artist::all()->pluck('id')->toArray();

    return [
        'name' => $faker->unique()->sentence(3),
        'artist' => $faker->randomElement($artistIds),
        'release' =>$faker->numberBetween(2000,2020),
    ];
});
