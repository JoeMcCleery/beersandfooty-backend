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
    $rand = random_int(1, 4);
    switch ($rand) {
        default:
        case 1:
            return [
                'type' => 'long_text',
                'content' => $faker->paragraph,
            ];
            break;
        case 2:
            return [
                'type' => 'short_text',
                'content' => $faker->paragraph(1),
            ];
            break;
        case 3:
            return [
                'type' => 'score',
                'content' => $faker->numberBetween(0, 100),
            ];
            break;
        case 4:
            return [
                'type' => 'image',
                'content' => 'https://via.placeholder.com/512?Text=BeersAndFooty.com',
            ];
            break;
    }
});
