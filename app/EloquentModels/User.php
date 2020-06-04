<?php

namespace App\EloquentModels;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * Calculate and return the current users score
     */
    public function score() {
        $score = 0;
        foreach ($this->reviews as $review) {
            foreach($review->votes as $vote) {
                $score += $vote->upvote ? 1 : -1;
            }
        }
        return $score;
    }

    /**
     * Add a mutator to ensure hashed passwords
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    /**
     * Validate the password of the user for the Passport password grant.
     *
     * @param  string  $password
     * @return bool
     */
    public function validateForPassportPasswordGrant($password)
    {
        return Hash::check($password, $this->password);
    }

    /**
     * Find the user instance for the given username.
     *
     * @param  string  $username
     * @return \App\EloquentModels\User
     */
    public function findForPassport($username)
    {
        return $this->where('username', $username)->first();
    }

    /**
     * Get the reviews posted by this user.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get the votes made by this user.
     */
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
