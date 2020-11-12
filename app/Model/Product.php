<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable =['name' , 'user_id','categories_id','price','description','slug'];

    protected $hidden =[];

    public function galleries()
    {
        return $this->hasMany(ProductGallery::class,'products_id','id');
    }

    public function user()
    {
        return $this->hasOne('App\User','id','user_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Model\Category','categories_id','id');
    } 
}
