<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'description', 'spot_id'
    ];

    public function spot()
    {
    	return $this->belongsTo('App\Spot')->withTimestamps();
    }

    public function user()
    {
    	return $this->belongsTo('App\User')->withTimestamps();
    }
}
