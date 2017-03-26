<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category()
    {
    	return $this->belongsTo('App\Category', 'category_id');
    }

    public function order_product()
    {
    	return $this->hasMany('App\OrderProduct', 'product_id');
    }
}
