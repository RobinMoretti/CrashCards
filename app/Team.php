<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $guarded = ['id'];
    
	public function workshop()
	{
		return $this->belongsTo(Workshop::class);
	}

	public function players()
	{
		return $this->belongsToMany(User::class);
	}

    public function fakePlayers()
    {
        return $this->hasMany(FakeUser::class);
    }
    
	public function hand()
	{
		return $this->hasOne(Hand::class);
	}

	public function leader()
	{
		return $this->belongsTo(User::class, 'leader_id');
	}

}
