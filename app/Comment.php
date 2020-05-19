<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class Comment extends Model
{
    protected $fillable = [
        'description', 'spot_id', 'user_id',
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
