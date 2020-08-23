<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $table = 'products';
    protected $guarded = [];

    public function category() {
        return $this->belongsTo('App\Category'); 
    }

    public function product_voucher() {
        return $this->hasMany('App\ProductVoucher'); 
    }

    public function country() {
        return $this->belongsTo('App\Country','country_id','country_id');   
    }

    public static function boot() {  
        parent::boot();

        static::deleting(function($cat) { // before delete() method call this
            $cat->product_voucher()->delete();
            // do the rest of the cleanup...
        });

        static::saving(function($model) {
            $slug = str_slug($model->name);
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();

            // if other slugs exist that are the same, append the count to the slug
            $model->slug = $count ? "{$slug}-{$count}" : $slug;
            return true;  
        });
    }
}  
