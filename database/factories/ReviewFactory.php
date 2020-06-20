<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\EloquentModels\Review;
use App\EloquentModels\ContentBlock;
use App\EloquentModels\User;
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
    $type = random_int(0,1);
    $published = random_int(0,1);
    return [
        'type' => $type ? 'beer' : 'footy',
        'status' => $published ? 'published' : 'hidden',
        'title' => $faker->text(16),
        'publish_date' => $faker->unixTime(),
        'user_id' => User::all()->random()
    ];
});

$factory->afterCreating(Review::class, function (Review $review, Faker $faker) {
    $rand = random_int(1, 4);
    $blocks = [];
    for ($index = 0; $index < $rand; $index++) {
        $blocks[] = factory(ContentBlock::class)->make(['sort' => $index]);
    }
    $review->content_blocks()->saveMany($blocks);
});
