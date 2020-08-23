<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;  

class OrderItem extends Model
{
	use SoftDeletes;
    protected $table = 'order_items';
    protected $guarded = []; 

    public function order() {
        return $this->belongsTo('App\Order');     
    }

    public function product() {
        return $this->belongsTo('App\Product');       
    }

    public function category()
    {     
        return $this->belongsTo('App\Category'); 
    }


}
