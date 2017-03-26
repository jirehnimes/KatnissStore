<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function order_product()
    {
    	return $this->hasMany('App\OrderProduct', 'order_id');
    }

    public function user()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }
}
