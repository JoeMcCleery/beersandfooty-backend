<?php

use App\EloquentModels\ContentBlock;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\EloquentModels\Review::class, 25)->create(['type' => 'beer']);
        factory(App\EloquentModels\Review::class, 25)->create(['type' => 'footy']);
    }
}
