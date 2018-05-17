<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'path', 'user_id', 'trick_id', 'spot_id',
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function trick()
    {
    	return $this->belongsTo('App\Trick');
    }

    public function spot()
    {
    	return $this->belongsTo('App\Spot');
    }
}
