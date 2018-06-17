<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'path', 'user_id', 'spot_id',
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function spot()
    {
    	return $this->belongsTo('App\Spot');
    }
}
