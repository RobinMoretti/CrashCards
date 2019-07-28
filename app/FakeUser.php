<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FakeUser extends Model
{
    protected $hidden = [
        'name',
    ];
    
    protected $fillable = [
        'username',
    ];

    public function workshops()
    {
        return $this->belongsTo(Workshop::class)->withTimestamps();
    }
}
