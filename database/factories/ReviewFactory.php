<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\EloquentModels\Review;
use App\EloquentModels\ContentBlock;
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

$factory->define(Review::class, function (Faker $faker) {
    return [
        'type' => 'beer',
        'title' => $faker->name,
        'publish_date' => $faker->dateTimeBetween('-30 days', 'now'),
    ];
});

$factory->afterCreating(Review::class, function (Review $review, Faker $faker) {
    $review->content_blocks()->saveMany(factory(ContentBlock::class, 3)->make());
});
