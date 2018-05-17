<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trick extends Model
{
    protected $fillable = [
        'name',
    ];

    public function videos()
    {
        return $this->hasMany('App\Video');
    }

    public function users()
    {
    	return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function spots()
    {
        return $this->belongsToMany('App\Spot')->withTimestamps();
    }
}
