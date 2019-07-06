<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function cards()
    {
        return $this->hasMany(Card::class, 'author_id')->withTimestamps();
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class);
    }

    public function workshops()
    {
        return $this->hasMany(Workshop::class, 'author_id')->withTimestamps();
    }

    public function decks()
    {
        return $this->hasMany(Deck::class);
    }
}
