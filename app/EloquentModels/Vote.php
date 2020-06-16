<?php

namespace App\EloquentModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vote extends Model
{

    public static function boot() {
        parent::boot();

        self::creating(function ($model) {
            self::updateReviewScore($model);
        });

        self::updating(function ($model) {
            self::updateReviewScore($model);
        });

        self::deleting(function ($model) {
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
