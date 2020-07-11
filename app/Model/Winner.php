<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{
    protected $table = 'winners';
    protected $fillable = ['user_id', 'offer_id'];

    // default value
    // public function setCreatedAtAttribute($value)
    // {
    //     $this->attributes[]
    // }


    ########################### start relations ##############################
    public function offer()
    {
        return $this->belongsTo('App\Model\Offer', 'offer_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    ########################### end relations ##############################


}// end of model
