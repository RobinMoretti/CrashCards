<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    protected $guarded = ['id'];

	public function author()
	{
		return $this->belongsTo(User::class, 'author_id');
	}
    public function links()
    {
    	return $this->hasMany(Link::class);
    }

    public function deck()
    {
    	return $this->belongsTo(Deck::class);    
    }

    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    public function participants()
    {
        return $this->belongsToMany(User::class);
    }
    public function fakePlayers()
    {
        return $this->hasManyThrough(FakeUser::class, Team::class);
    }

}
