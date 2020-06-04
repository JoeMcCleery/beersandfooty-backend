<?php

use App\EloquentModels\Review;
use App\EloquentModels\User;
use App\EloquentModels\Vote;
use Illuminate\Database\Seeder;

class VoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Review::all() as $review) {
            foreach (User::all() as $user) {
                $makeVote = random_int(0,5);
                if($makeVote === 0) {
                    $vote = factory(Vote::class)->create();
                    $user->votes()->save($vote);
                    $review->votes()->save($vote);
                }
            }
        }
    }
}
