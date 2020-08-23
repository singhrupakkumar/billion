<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{

    protected $fillable = [ 
        'name','slug','description'
    ];
    public static function boot()
{
    parent::boot();

    static::saving(function($model) { 
        $model->slug = str_slug($model->name);

        return true;
    });
}

}
