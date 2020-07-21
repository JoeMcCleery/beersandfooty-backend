<?php

namespace App\EloquentModels;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{

    public static function boot() {
        parent::boot();

        self::created(function ($model) {
            self::updateReviewScore($model);
        });

        self::updated(function ($model) {
            self::updateReviewScore($model);
        });

        self::deleted(function ($model) {
            self::updateReviewScore($model);
        });
    }

    private static function updateReviewScore($model) {
        $review = $model->review;
        $review->score = $review->getScore();
        $review->save();
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'votes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'upvote'
    ];

    /**
     * Get the user that owns this vote.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the review that owns this vote.
     */
    public function review()
    {
        return $this->belongsTo(Review::class);
    }
}
