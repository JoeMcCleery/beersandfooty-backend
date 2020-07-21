<?php

namespace App\EloquentModels;

use Illuminate\Database\Eloquent\Model;

class ContentBlock extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'content_blocks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sort', 'type', 'content',
    ];

    /**
     * Get the review that owns this content block.
     */
    public function review()
    {
        return $this->belongsTo(Review::class);
    }
}
