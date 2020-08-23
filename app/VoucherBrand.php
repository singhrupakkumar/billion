<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class VoucherBrand extends Model
{
    use SoftDeletes;
    protected $table = 'voucher_brands';  
    protected $guarded = [];  

    public function voucher() {
        return $this->hasMany('App\Voucher', 'brand_id'); 
    }

    public static function boot() {  
        parent::boot();   
        static::deleting(function($cat) { // before delete() method call this
            $cat->voucher()->delete();  
            // do the rest of the cleanup...
        }); 
    }
}
