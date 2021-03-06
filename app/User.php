<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAvatar()
    {
        return asset('image/' . $this->avatar);
    }

    ########################### start relations ##############################
    public function posts()
    {
        return $this->hasMany('App\Model\Post', 'user_id', 'id');
    }
    public function comments()
    {
        return $this->hasMany('App\Model\Comment', 'user_id', 'id');
    }
    public function notifications()
    {
        return $this->hasMany('App\Model\Notification', 'user_id', 'id');
    }
    public function winners()
    {
        return $this->hasMany('App\Model\Winner', 'user_id', 'id');
    }
    ########################### end relations ##############################


}
