<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable =[
                    'user_id' , 
                    'inscurance_price',
                    'shipping_price',
                    'total',
                    'code',
                    'transaction_status',
                ];

    protected $hidden =[];

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
}
