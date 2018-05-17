<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spot extends Model
{
    protected $fillable = [
        'lat', 'lng', 'description',
    ];

    public function videos()
    {
        return $this->hasMany('App\Video');
    }

    public function tricks()
    {
    	return $this->belongsToMany('App\Trick')->withTimestamps();
    }
}
