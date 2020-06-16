<?php

namespace App\EloquentModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use SoftDeletes;

    public static function boot() {
        parent::boot();

        self::created(function ($model) {
            self::updateUserScore($model);
        });

        self::updated(function ($model) {
            self::updateUserScore($model);
        });

        self::deleted(function ($model) {
            self::updateUserScore($model);
        });
    }

    private static function updateUserScore($model) {
        $user = $model->user;
        $user->score = $user->getScore();
        $user->save();
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'reviews';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'title', 'publish_date', 'status'
    ];

    /**
     * Get the content blocks for the review.
     */
    public function content_blocks()
    {
        return $this->hasMany(ContentBlock::class);
    }

    /**
     * Get the votes for the review.
     */
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    /**
     * Get the user that owns this review.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Calculate and return the current review's score
     */
    public function getScore()
    {
        $score = 0;
        $votes = $this->votes;
        if($votes) {
            foreach ($votes as $vote) {
                $score += $vote->upvote ? 1 : -1;
            }
        }
        return $score;
    }
}
