<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table = 'offers';
    protected $fillable = [
        'title',
        'details',
        'price',
        'photo',
        //not in db
        'photo_url'
    ];


    public function getPhotoUrlAttribute()
    {
        return !empty($this->photo)? asset('upload/image/offers/' . $this->photo): asset('image/offer.jpg');
    }

    ########################################## start scope #################################
    public function scopeSelection($query)
    {
        return $query->select('id', 'title', 'details', 'photo')->get();
    }
    ########################################## end scope #################################


    ########################### start relations ##############################
    public function orders()
    {
        return $this->hasMany('App\Model\Order', 'offer_id', 'id');
    }
    ########################### end relations ##############################



}// end model
