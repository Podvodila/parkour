<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'description', 'spot_id', 'user_id',
    ];

    public function spot()
    {
    	return $this->belongsTo('App\Spot');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function show()
    {
        return ['comment' => $this, 'user' => $this->user];
    }
}
