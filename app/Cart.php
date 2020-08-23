<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';
    protected $guarded = []; 

    public function product() {
        return $this->belongsTo('App\Product');      
    }

    public function category() {
        return $this->belongsTo('App\Category');        
    }

    public function voucher_brand() {
        return $this->belongsTo('App\VoucherBrand','voucher_brand_id');         
    }
}
  