<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable =['products_id' , 'user_id'];

    protected $hidden =[];

    public function product()
    {
        return $this->hasOne('App\Model\Product','id','products_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
}
