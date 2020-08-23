<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CancellationReason extends Model
{
    protected $table = 'cancellation_reasons';
    // protected $fillable = [ 
    //     'location','user_id','house_no','title','type','lat','lng'
    // ];
    protected $guarded = [];
}
