<?php

namespace App\EloquentModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use SoftDeletes;

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
        'type', 'title', 'post_date',
    ];

    /**
     * Get the content blocks for the review.
     */
    public function content_blocks()
    {
        return $this->hasMany(ContentBlock::class);
    }

    /**
     * Get the user that owns this review.
     */
    public function review()
    {
        return $this->belongsTo(User::class);
    }
}
