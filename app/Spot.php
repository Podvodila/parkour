<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spot extends Model
{
    protected $fillable = [
        'lat', 'lng', 'description', 'user_id'
    ];

    public function videos()
    {
        return $this->hasMany('App\Video');
    }

    public function tricks()
    {
    	return $this->belongsToMany('App\Trick')->withTimestamps();
    }

    public function images()
    {
        return $this->hasMany('App\Image')->withTimestamps();
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
