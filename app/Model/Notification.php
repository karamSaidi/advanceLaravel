<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';
    protected $fillable = [
        'user_img',
        'title',
        'content',
        'user_id',
        'url',
        'seen',
    ];


    ################## start relation ################
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    ################## end relation ################


    ################## start scope ################
    public function scopeNotseen($query)
    {
        return $query->where('seen', 0)->get();
    }
    ################## end scope ################


}
