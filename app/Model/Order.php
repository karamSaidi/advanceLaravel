<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable  = [
        'offer_id',
        'transaction_id',
        'transaction_info',
    ];


    ########################### start relations ##############################
    public function offer()
    {
        return $this->belongsTo('App\Model\Offer', 'offer_id', 'id');
    }
    ########################### end relations ##############################




    public function getTransactionInfoAttribute($value)
    {
        return  !empty($value)? collect(json_decode($value, true)): '';
        // return json_decode($value, true);
    }

    public function getTransactionInfoArray()
    {
        return !empty($this->transaction_info)? collect(json_decode($this->transaction_info, true)): '';
    }


}// end of model
