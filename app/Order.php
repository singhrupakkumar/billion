<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
	use SoftDeletes;
    protected $table = 'orders';
    protected $guarded = [];

    public function orderItem() {
        return $this->hasMany('App\OrderItem');  
    }

    public function payments() {
        return $this->hasMany('App\PaymentHistory');    
    }

    public function user() {
        return $this->belongsTo('App\User');       
    }

    public function country() {  
        return $this->belongsTo('App\Country','country_id','country_id');   
    }

    public function orderStatus() {
        return $this->belongsTo('App\OrderStatus','status');          
    }

    public function coupon() {
        return $this->belongsTo('App\CouponCode','coupon_id');          
    }

}
