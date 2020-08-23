<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    protected $table = 'payment_histories';
    protected $guarded = [];


    public function booking()
    {
        return $this->belongsTo('App\Order');
    }
 
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
