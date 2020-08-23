<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductVoucher extends Model
{
    protected $table = 'product_vouchers';
    protected $guarded = [];

    public function voucher_brand() {
        return $this->belongsTo('App\VoucherBrand'); 
    }

}  
