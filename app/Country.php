<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries'; 

    public static function countrieslist()
    {
        return Country::get();  
    } 
}
