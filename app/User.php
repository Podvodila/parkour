<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'login', 'password', 'facebook', 'instagram'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function videos()
    {
        return $this->hasMany('App\Video');
    }

    public function tricks()
    {
        return $this->belongsToMany('App\Trick')->withTimestamps();
    }

    public function spots()
    {
        return $this->belongsToMany('App\Spot');
    }

    public function image()
    {
        return $this->hasOne('App\Image')->withTimestamps();
    }

    public function images()
    {
        return $this->hasMany('App\Image')->withTimestamps();
    }
}
