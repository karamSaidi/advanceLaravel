<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = [
        'comment',
        'post_id',
        'user_id',
    ];


    ########################### start scope #########################

    ########################### end scope #########################


    ########################### start relation #########################
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function post()
    {
        return $this->belongsTo('App\Model\Post', 'post_id', 'id');
    }
    ########################### end relation #########################


}
