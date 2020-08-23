<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;  
class City extends Model
{
    protected $table = 'city';

    protected $fillable = [ 
        'name','lat','lng','country'
    ];     

    public static function cityList()
    {
        return City::where(['status'=>0,'is_deleted'=>0])->get();  
    }
    
     public static function cityByLatLng($lat = 0, $lng = 0, $distance = 50)
    {
         // In miles -- 1 mile = 1.60934 km  
        $result = City::select(
                        DB::raw("*,
                          ( 6371 * acos( cos( radians(?) ) *
                            cos( radians( lat ) )
                            * cos( radians( lng ) - radians(?)
                            ) + sin( radians(?) ) *
                            sin( radians( lat ) ) )
                          ) AS distance"))
                ->having("distance", "<", "?")
                ->orderBy("distance")
                ->where('is_deleted', '=', "?")
                ->where('status', '=', "?")
                ->setBindings([$lat, $lng, $lat, 0, 0, $distance])
                ->first();


        //  return $result->id;   
        if ($result) {
            $search = $result->id;
        } else {
            $search = 0;
        } 
        return $search;  
    }
}
