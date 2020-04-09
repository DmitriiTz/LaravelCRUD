<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Song;
use App\User;
use App\Artist;
use App\Album;
use Faker\Generator as Faker;

$factory->define(Song::class, function (Faker $faker) {

    $userIds = User::all()->pluck('id')->toArray();
    $artistIds = Artist::all()->pluck('id')->toArray();
    $albumIds = Album::all()->pluck('id')->toArray();

    return [
        'name' => $faker->unique()->sentence(3),
        'artist' => $faker->randomElement($artistIds),
        'album' => $faker->randomElement($albumIds),
        'release' => $faker->numberBetween(2000,2020),
        'duration' => $faker->randomFloat(3,0, 10),
        'user' => $faker->randomElement($userIds),
    ];
});
