<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderVoucher extends Model
{
    protected $table = 'order_vouchers';
    protected $guarded = []; 

    public function voucher_brand() {
        return $this->belongsTo('App\VoucherBrand','voucher_brand_id');     
    }

    public function voucher()
    {     
        return $this->belongsTo('App\Voucher');      
    }


}
