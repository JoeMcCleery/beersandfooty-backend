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
        $users = User::all();
        $reviews = Review::all();
        $userCount = $users->count();
        foreach ($reviews as $review) {
            $rand = random_int(1, $userCount);
            foreach ($users->random($rand) as $user) {
                factory(Vote::class)->create(['user_id' => $user->id, 'review_id' => $review->id]);
            }
        }
    }
}