<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Blog;
use Faker\Generator as Faker;

$factory->define(Blog::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'body' => Str::random(100),
        'author' => $faker->name,
        'author_id' => $faker->numberBetween(1, 20),
    ];
});
