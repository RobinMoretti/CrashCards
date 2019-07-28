<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable
{
    use Notifiable;

    protected $hidden = [
        'password',
        'remember_token',
        'email',
        'name',
        'email_verified_at',
        'created_at',
        'updated',
    ];
    
    protected $fillable = [
        'name', 'email', 'password',
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

    public function workshopsAsParticipant()
    {
        return $this->belongsToMany(Workshop::class);
    }
}
