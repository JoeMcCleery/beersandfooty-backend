<?php

use App\EloquentModels\Review;
use App\EloquentModels\User;
use App\EloquentModels\Vote;
use Illuminate\Database\Seeder;

class VoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *  Creates up to (usercount * reviewcount) number of votes
     * @return void
     */
    public function run()
    {
        factory(Vote::class, 12800)->create();
    }
}
