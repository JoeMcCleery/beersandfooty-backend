<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

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

$factory->define(ContentBlock::class, function (Faker $faker) {
    return [
        'type' => 'long_text',
        'content' => $faker->paragraph,
    ];
});
