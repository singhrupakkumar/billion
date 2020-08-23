<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
       
        app('view')->composer('admin.common.sidebar', function ($view) {
            $action = app('request')->route()->getAction();
    
            $controller = class_basename($action['controller']);
    
            list($controller, $action) = explode('@', $controller);
    
            $view->with(compact('controller', 'action'));
        }); 
    }
}
