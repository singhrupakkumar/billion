<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

class MyApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
    
        $tok = $request->header('Authorization');
        if(!$tok)return response()->json(['success'=>false,'message'=>'Unauthorised'], 401);
         $key= explode(' ', $tok);   

       if(!isset($key[1]))return response()->json(['success'=>false,'message'=>'Unauthorised'], 401);  
         $user  = User::where('api_token',$key[1])->first();  
         if(!$user){
           return response()->json(['success'=>false,'message'=>'Unauthorised'], 401); 
         }

         \Auth::login($user); 
        return $next($request);
    }
}
