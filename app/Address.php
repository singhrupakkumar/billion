<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';
    protected $guarded = [];   
//    protected $fillable = [ 
//        'location','user_id','house_no','title','type','lat','lng'
//    ];         
}
