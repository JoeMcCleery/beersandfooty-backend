<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\EloquentModels\Vote;
use App\EloquentModels\User;
use App\EloquentModels\Review;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Vote::class, function (Faker $faker) {
    return [
        'upvote' => $faker->boolean(),
        'user_id' => User::all()->random(),
        'review_id' => Review::all()->random()
    ];
});
