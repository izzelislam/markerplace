<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $fillable =[
                    'transactions_id' , 
                    'prodects_id',
                    'price_id',
                    'resi',
                    'shipping_status',
                    'code',
                ];

    protected $hidden =[];

    public function product()
    {
        return $this->hasOne('App\Model\Product','id','prodects_id');
    }

    public function transaction()
    {
        return $this->hasOne('App\Model\Transaction','id','prodects_id');
    }

}
