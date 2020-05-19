<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class Video extends Model
{
    protected $fillable = [
        'path', 'user_id', 'trick_id', 'spot_id',
    ];

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

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
